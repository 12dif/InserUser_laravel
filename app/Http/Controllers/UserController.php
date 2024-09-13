<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rules\File;


class UserController extends Controller
{
   public function home(){

       $users=User::orderBy('id','desc')->paginate(2);
       return view('user.show',compact('users'));
   }

   public function showFormCreate(){
       return view('user.create');
   }
   public function createUser( Request $request)
   {
       $validator = Validator::make($request->all(), [
           'nom' => 'required|max:50',
           'email' => 'required|email|unique:users',
           'tel' => 'required',
           'file' => [
               'required',
               File::image()
                   ->min('100kb')
                   ->max('1mb')

           ],
       ]);

       if ($validator->fails()) {
           return redirect()
               ->route('user.create')
               ->withErrors($validator)
               ->withInput();
       }else{
           $file = $request->file('file');
           $name = time().$file->getClientOriginalName();

           $request->file('file')->storeAs(
               'imageUser',
               $name,
               'public'
           );

           User::create([
               'name'=>$request->nom,
               'tel'=>$request->tel,
               'email'=>$request->email,
               'image'=>$name
           ]);

           return redirect()->route('user.show');
       }
   }

   public function deleteUser(string $id){
      $user=User::findOrFail($id);

      $imageLink=public_path('storage/imageUser/'.$user->image);
      \Illuminate\Support\Facades\File::delete($imageLink);

      $user->delete();

      return redirect()->route('user.show');
}

    public function showFormupdate(string $id){
       $user=user::findOrFail($id);

       return view('user.update',compact ('user'));
    }
    public function updateUser(string $id, Request $request){
        $file = $request->file('file');

        if ($file===null){

            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'email' => 'required|email',
                'tel' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect("/user/update/$id")
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $user=User::findOrFail($id);

                $user->update([
                    'name'=>$request->nom,
                    'tel'=>$request->tel,
                    'email'=>$request->email,

                ]);
                return redirect()->route('user.show');

            }

        }else{
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'email' => 'required|email',
                'tel' => 'required',
                'file' => [
                    'required',
                    File::image()
                        ->min('1kb')
                        ->max('1mb')

                ],
            ]);

            if ($validator->fails()) {
                return redirect("/user/update/$id")
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $user=user::findOrFail($id);
                $file = $request->file('file');

                $name = time().$file->getClientOriginalName();

                $request->file('file')->storeAs(
                    'imageUser',
                    $name,
                    'public'
                );

                $user->update([
                    'name'=>$request->nom,
                    'tel'=>$request->tel,
                    'email'=>$request->email,
                    'image'=>$name
                ]);
                return redirect()->route('user.show');

            } }
    }

    public function setLang(string $locale){
       session (['lang'=>$locale]);
       return back();
    }

}
