<?php 
namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait {
	
	public function returnExeption($req,$exep){


		if($exep instanceof ModelNotFoundException)
        {
            return $this->isModal($req,$exep);
        }
        if ($exep instanceof NotFoundHttpException) {

        	return $this->isHttp($req,$exep);
           
        }
        
        return parent::render($req,$exep);

	}

	protected function isModel($req,$exep){
		 return response()->json([
                'error' => 'Data not found'
            ], 404);
	}

	protected function isHttp($req,$exep){
		 return response()->json([
                'error' => 'API endpoint is not found'
            ], 404);
	}
}


?>