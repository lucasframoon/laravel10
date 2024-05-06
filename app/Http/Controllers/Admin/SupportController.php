<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;

class SupportController extends Controller
{

    public function index(Support $supports)
    {
        $supports = Support::all();

        return view('admin.supports.index', compact('supports'));
    }

    public function create()
    {
        return view('admin.supports.create');
    }

    public function store(StoreUpdateSupportRequest $request, Support $support)
    {
        $data = $request->validated();
        $data['status'] = 'a';

        $support->create($data);
        return redirect()->route('supports.index');
    }

    public function show(Support $support, string|int $id)
    {
        if (!$support = $support->find($id))
            return back();
        
        return view('admin.supports.show', compact('support'));
    }

    public function edit(Support $support, string|int $id)
    {
        if (!$support = $support->find($id))
            return back();
        
        return view('admin.supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupportRequest $request, Support $support, string|int $id) {
        if (!$support = $support->find($id))
            return back();
        
        $support->update($request->validated());
        
        return redirect()->route('supports.index');
    }

    public function destroy(Support $support, string|int $id) {
        if (!$support = $support->find($id))
            return back();
        
        $support->delete();
        
        return redirect()->route('supports.index');
    }
}
