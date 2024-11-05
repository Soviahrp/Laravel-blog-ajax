<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Backend\WriterService;

class WriterController extends Controller
{
    public function __construct(private WriterService $writerService)
    {
        $this->middleware('owner');
    }

    public function index(): View
    {
        return view('backend.writers.index');
    }

    public function serverside(Request $request): JsonResponse
    {
        return $this->writerService->dataTable($request);
    }

    public function show($id): JsonResponse
    {
        try {
            $writer = $this->writerService->getFirstBy('id', $id);
            return response()->json(['data' => $writer]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'verification_status' => 'required|in:verified,unverified',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }

            // Process the update
            $data = [
                'is_verified' => $request->verification_status === 'verified' ? now() : null,
            ];

            $this->writerService->update($data, $id);

            return response()->json(['message' => 'verification berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        $getData = $this->writerService->getFirstBy('id', $id);

        $getData->delete();

        return response()->json(['message' => 'Data Writer Berhasil Dihapus!']);
    }
}
