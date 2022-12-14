<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContract;
use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $counter;

    public function __construct(CounterContract $counter)
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
        $this->counter = $counter;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function show(User $user)
    {

        return view('users.show', [
            'user' => $user,
            'counter' => $this->counter->increment("$user->id")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        if ($request->hasFile('avatar')){
            $path = $request->file('avatar')->store('avatars');

            if ($user->image){
                $user->image->path = $path;
                $user->image->save();
            } else {
                $user->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }


        $user->locale = $request->input('locale');
        $user->name = $request->input('name');
        $user->save();

        return redirect()
//            ->route('users.show', ['user' => $user])
            ->back()
            ->withStatus('Profile was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
