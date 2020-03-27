<?php
  
namespace App\Http\Middleware;
  
use Closure;
use Auth;
   
class IsAdmin
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
        if (Auth::check()) {
            if(auth()->user()->level_id == 1){
                return $next($request);
            }
            //Condition if level equal to operator(2)
            else if(auth()->user()->level_id == 2){
                return redirect()->route('operator.home')->with('error',"You don't have admin access.");
            }
            //Condition if level equal to eksekutif(3)
            else if(auth()->user()->level_id == 3){
                return redirect()->route('eksekutif.home')->with('error',"You don't have admin access.");
            }
            return redirect()->route('login')->with('error',"You don't have admin access.");
        }
        else{
            return redirect('login')->with('error',"You don't have admin access.");
        }
    }
}