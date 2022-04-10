<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Firebase\JWT\JWT;
use CodeIgniter\API\ResponseTrait;

class AuthFilter  implements FilterInterface
{
	use ResponseTrait;

	public function before(RequestInterface $request, $arguments = null)
	{
		//valida por Bearer Token
		//$key        = Services::getSecretKey();
		//$authHeader = $request->getServer('HTTP_AUTHORIZATION');
		//$arr        = explode(' ', $authHeader);
		//$token      = $arr[1];

		//validar por header
		$key        = Services::getSecretKey();
		$token = $request->getServer('HTTP_AUTHORIZATION');
		
		try
		{
			JWT::decode($token, $key, ['HS256']);
			
		}
		catch (\Exception $e)
		{
			
			return Services::response()
				->setJSON(['mensaje'=>'Filter dice error de Token']);
		
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		

		
	}
}