<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Product;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    public $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the project.
     */
    public function index(Request $request)
    {
        $search = $request->q;
        $projects = Project::with('product')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    // Cari di produk
                    $q->whereHas('product', function ($q2) use ($search) {
                        $q2->where('nama_produk', 'like', "%{$search}%");
                    })
                        // Cari di kode transaksi
                        ->orWhere('company_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Create project
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.projects.add_project', compact('products'));
    }

    /**
     * Store project
     */
    public function store(CreateProjectRequest $request)
    {
        try {
            $project = $this->projectService->create($request->all());
            Session()->flash('status', 'Project berhasil dibuat.');

            return response()->json([
                'success' => true,
                'message' => 'Project successfully created.',
                'data'    => $project,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Detail proejct
     */
    public function show(string $id)
    {
        $projects = Project::with(['product'])->findOrFail($id);
        return view('admin.projects.detail_project', compact('projects'));
    }

    /**
     * Edit project
     */
    public function edit(string $id)
    {
        $projects = Project::with(['product'])->findOrFail($id);
        return view('admin.projects.edit_project', compact('projects'));
    }

    /**
     * Update project
     */
    public function update(Request $request, string $id)
    {
        try {
            $projectData = Project::findOrFail($id);
            $project = $this->projectService->update($request->all(), $projectData);
            // Session()->flash('status', 'Project updated.');

            return response()->json([
                'success' => true,
                'message' => 'Project updated.',
                'data'    => $project,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            // hapus media terkait
            $project->clearMediaCollection('project-gallery');

            // hapus project
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Project berhasil dihapus.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
