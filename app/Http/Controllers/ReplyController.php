<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    public function index(Question $question)
    {
        return ReplyResource::collection(Reply::where('question_id', $question->id)->latest()->get());
    }

    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());

        return response(['reply' => new ReplyResource($reply)], 201);
    }

    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    public function update(Question $question, Request $request, Reply $reply)
    {
        $reply->update($request->all());

        return response('Updated', Response::HTTP_ACCEPTED);
    }

    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
