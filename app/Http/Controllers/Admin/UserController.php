<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @var array
     */
    protected $breadcrumbs;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            route('admin.users.index') => __('global.titles.users_index'),
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var User $users */
        $users = User::orderBy('id', 'ASC');

        if ($param = $request->search) {
            $users->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.users.index', [
            'users' => $users->paginate(20)
        ]);
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(UserRequest $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                /** @var User $user */
                $user = User::create($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_store'), 'success');
                return redirect()->route('admin.users.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_store'), 'danger', 5000);
                return redirect()->back();
            }
        }

        return view('admin.users.create', [
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @param UserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, UserRequest $request)
    {
        /** @var User $user */
        $user = User::find($id);
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $user->update($request->all());
                DB::commit();
                messages(__('global.titles.success'), __('messages.success_update'), 'success');
                return redirect()->route('admin.users.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                messages(__('global.titles.danger'), __('messages.error_update'), 'danger', 5000);
                return redirect()->route('admin.users.edit', $id);
            }
        }

        return view('admin.users.edit', [
            'user' => $user,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            User::find($id)->delete();
            DB::commit();
            messages(__('global.titles.success'), __('messages.success_trashed'), 'success', 6000);
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            messages(__('global.titles.danger'), __('messages.error_trashed'), 'danger', 6000);
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trashed(Request $request)
    {
        $users = User::orderBy('deleted_at', 'DESC')->onlyTrashed();

        if ($param = $request->search) {
            $users->where('id', 'LIKE', "%{$param}%");
        }

        return view('admin.users.trashed', [
            'users' => $users->paginate(20)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = User::where('id', $id)->onlyTrashed()->first();
            $user->restore();
            DB::commit();
            messages(__('global.titles.success'), __('messages.success_restore'), 'success');
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            messages(__('global.titles.danger'), __('messages.error_retore'), 'danger');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = User::where('id', $id)->onlyTrashed()->first();
            $user->forceDelete();
            DB::commit();
            messages(__('global.titles.success'), __('messages.success_destroy'), 'success');
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            messages(__('global.titles.danger'), __('messages.error_destroy'), 'danger');
            return redirect()->back();
        }
    }
}
