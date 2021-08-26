<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Example;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->has('sort') || $request->sort == 'DateDesc')
            $examples = Example::getAll()->sortByDesc('id');
        else if($request->sort == 'DateAsc')
            $examples = Example::getAll()->sortBy('id');
        else if($request->sort == 'TitleAsc')
            $examples = Example::getAll()->sortBy('Title');
        else if($request->sort == 'TitleDesc')
            $examples = Example::getAll()->sortByDesc('Title');
        else if($request->sort == 'Approved')
            $examples = Example::getAll()->sortByDesc('Is Approved');
        else
            $examples = Example::getAll()->sortBy('Is Approved');

        return view('examples.index')->with([
            'examples' => $examples,
        ]);
    }

    public function create()
    {
        return view('examples.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
        ]);

        Example::store([
            'Title' => $request->title,
            'Url' => $request->url,
            'Is Approved' => $request->is_approved,
            'Date Added' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function edit($exampleId, Request $request)
    {
        return view('examples.edit')->with([
            'example' => Example::findById($exampleId),
        ]);
    }

    public function update($exampleId, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
        ]);

        Example::updateById($exampleId, $request->except(['_token', '_method']));

        return redirect('/');
    }

    public function delete($exampleId)
    {
        Example::deleteById($exampleId);

        return redirect('/');
    }

    public function download()
    {
        return response()->download(Example::getPathToCsv());
    }
}
