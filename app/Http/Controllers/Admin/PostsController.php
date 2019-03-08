<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostsRequest;
use App\Http\Requests\Admin\UpdatePostsRequest;
use Yajra\DataTables\DataTables;

class PostsController extends Controller
{
    /**
     * Display a listing of Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('post_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Post::query();
            $query->with("idUser");
            $query->with("idProject");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('post_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'posts.id',
                'posts.created',
                'posts.idUser_id',
                'posts.description',
                'posts.idProject_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'post_';
                $routeKey = 'admin.posts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('idUser.name', function ($row) {
                return $row->idUser ? $row->idUser->name : '';
            });
            $table->editColumn('idProject.name', function ($row) {
                return $row->idProject ? $row->idProject->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.posts.index');
    }

    /**
     * Show the form for creating new Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('post_create')) {
            return abort(401);
        }
        
        $id_users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.posts.create', compact('id_users', 'id_projects'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param  \App\Http\Requests\StorePostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostsRequest $request)
    {
        if (! Gate::allows('post_create')) {
            return abort(401);
        }
        $post = Post::create($request->all());



        return redirect()->route('admin.posts.index');
    }


    /**
     * Show the form for editing Post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('post_edit')) {
            return abort(401);
        }
        
        $id_users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post', 'id_users', 'id_projects'));
    }

    /**
     * Update Post in storage.
     *
     * @param  \App\Http\Requests\UpdatePostsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, $id)
    {
        if (! Gate::allows('post_edit')) {
            return abort(401);
        }
        $post = Post::findOrFail($id);
        $post->update($request->all());



        return redirect()->route('admin.posts.index');
    }


    /**
     * Display Post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('post_view')) {
            return abort(401);
        }
        $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }


    /**
     * Remove Post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('post_delete')) {
            return abort(401);
        }
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Delete all selected Post at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('post_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Post::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('post_delete')) {
            return abort(401);
        }
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Permanently delete Post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('post_delete')) {
            return abort(401);
        }
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('admin.posts.index');
    }
}
