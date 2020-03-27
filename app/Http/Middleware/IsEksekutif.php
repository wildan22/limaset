<?php
  
namespace App\Http\Middleware;
  
use Closure;
use Auth;
 
class IsEksekutif
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(auth()->user()->level_id == 3){
                return $next($request);
            }
            //Condition if level equal to operator(2)
            else if(auth()->user()->level_id == 2){
                return redirect()->route('operator.home')->with('error',"You don't have priveleges to access");
            }
            //Condition if level equal to admin(1)
            else if(auth()->user()->level_id == 1){
                return redirect()->route('admin.home')->with('error',"You don't have priveleges to access");
            }
            return redirect()->route('login')->with('error',"You don't have priveleges to access");
        }else{
            return redirect()->route('login')->with('error',"You don't have priveleges to access");
        }
    }
}