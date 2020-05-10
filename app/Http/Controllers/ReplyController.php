<?php

namespace App\Http\Controllers;

use App\Events\DeleteReply;
use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    public function index(Question $question)
    {
        return ReplyResource::collection(Reply::where('question_id', $question->id)->latest()->get());
    }

    public function store(Question $question, Request $request)
    {
        $request['user_id'] = auth()->id();
        $reply = $question->replies()->create($request->all());
        if($question->user_id !== $request->user_id) {
            $user = $question->user;
            $user->notify(new NewReplyNotification($reply));
        }

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
        broadcast(new DeleteReply($reply->id))->toOthers();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
