<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Admin\BlogService;
use App\Traits\LogsActivity;

class BlogController extends Controller
{
    protected $blogService;
    protected $paginationLimit = 10;
    use LogsActivity;

    public function __construct(BlogService $blogService)
    {
        $this->middleware('auth');
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $blogs = $this->blogService->getAllblogs($search, $this->paginationLimit);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function getdata(Request $request)
    {
        $search = $request->input('search');
        $blogs = $this->blogService->getAllblogs($search, $this->paginationLimit);

        return response()->json(['blogs' => $blogs]);
    }

    public function store(Request $request)
    {
        $validationErrors = $this->blogService->validateBlog($request->all());

        if ($validationErrors) {
            return response()->json(['errors' => $validationErrors]);
        }

        $fileName = $this->handleFileUpload($request);
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $fileName,
            'description' => $request->description,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' => $request->focus_keywords,
        ];

        $this->blogService->createBlog($data);
        $this->LogActivity('create_blog', 'Created new blog blog_name : ' . $request->name ??'');
        return response()->json(['success' => 'Blog created successfully']);
    }


    public function edit($id)
    {
        $blog = $this->blogService->findBlogById($id);

        if ($blog) {
            return response()->json(['blog' => $blog]);
        }

        return response()->json(['error' => 'Blog not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $validationErrors = $this->blogService->validateBlog($request->all(), $id);
        $blog = $this->blogService->findBlogById($id);

        if ($validationErrors) {
            return response()->json(['errors' => $validationErrors]);
        }

        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path('uploads/blog/' . $blog->image))) {
                unlink(public_path('uploads/blog/' . $blog->image));
            }
            $fileName = $this->handleFileUpload($request);
        } else {
            $fileName = $blog->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $fileName,
            'description' => $request->description,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' => $request->focus_keywords,
        ];

        $this->blogService->updateBlog($id, $data);
        $this->LogActivity('update_blog', 'Update blog id:'.$request->id??'');
        return response()->json(['success' => 'Blog updated successfully']);
    }

    public function destroy($id)
    {

        $blog = $this->blogService->findBlogById($id);

        $deleteBlog = $this->blogService->deleteBlog($id);
        if ($deleteBlog) {
            if ($blog->image && file_exists(public_path('uploads/blog/' . $blog->image))) {
                unlink(public_path('uploads/blog/' . $blog->image));
            }
        }
        $this->LogActivity('delete_blog', 'Delete blog  id:'.$id??'');
        return response()->json(['success' => 'Blog deleted successfully']);
    }

    public function updateStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:1,0',
        ]);

        $attributes = ['id' => $request->id];
        $data = ['status' => $request->status];
        $result = $this->blogService->updateStatus($attributes, $data);
        if (!$result) {
            return response()->json(['error' => 'Failed to update blog status'], 500);
        }
        $this->LogActivity('update_blog_status', 'Update blog  id:'.$request->id??'');
        return response()->json(['success' => 'Status updated successfully']);
    }

    private function handleFileUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . mt_rand(100000, 999999) . '.' . $extension;
            $file->move(public_path('uploads/blog'), $fileName);
            return $fileName;
        }
        return null;
    }
}
