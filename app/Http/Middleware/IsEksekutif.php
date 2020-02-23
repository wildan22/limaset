<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
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
        if(auth()->user()->level_id == 3){
            return $next($request);
        }
        //Condition if level equal to operator(2)
        else if(auth()->user()->level_id == 2){
            return redirect('operator.dashboard')->with('error',"You don't have priveleges to access");
        }
        //Condition if level equal to admin(1)
        else if(auth()->user()->level_id == 1){
            return redirect('admin.dashboard')->with('error',"You don't have priveleges to access");
        }
        return redirect('login')->with('error',"You don't have priveleges to access");
    }
}