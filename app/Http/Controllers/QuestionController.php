<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        return QuestionResource::collection(Question::latest()->paginate(4));
    }

    public function store(QuestionRequest $request)
    {
        $request['slug'] = Str::slug($request->title);
        $question = auth()->user()->question()->create($request->all());

        return response(new QuestionResource($question), 201);
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function update(Request $request, Question $question)
    {
        $request['slug'] = Str::slug($request->title);
        $question->update($request->all());

        return response('Updated', Response::HTTP_ACCEPTED);
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getCategory($id)
    {
        return QuestionResource::collection(Question::where('category_id', $id)->paginate(4));
    }
}
