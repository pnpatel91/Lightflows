<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation
- git clone
- composer install
- cp .env.example .env
- php artisan key:generate
- setup database in .env
- php artisan migrate --seed
- php artisan passport:install --force
- php artisan serve
- The site will run localhost:8000

## End Point Url

 |POST      | api/register |

 |GET|HEAD  | api/user |

 |POST | api/login | 


 |GET|HEAD  | api/phonebooks  | phonebooks.index |

 |POST      | api/phonebooks  | phonebooks.store | 

 |GET|HEAD  | api/phonebooks/{phonebook}  | phonebooks.show | 

 |PUT|PATCH | api/phonebooks/{phonebook}  | phonebooks.update |

 |DELETE    | api/phonebooks/{phonebook}  | phonebooks.destroy |


## Support Documentation
	
 1) User Register

 	Url : {Your_Path}/api/register

 	Method - POST 

 	Body : row
 	
 	Data : 

 			{
			    "name": "Admin",
			    "email":"new_admin@gmail.com",
			    "password":"password",
			    "c_password":"password"
			}

	The command will return the following format: 

												{
												    "success": true,
												    "data": {
												        "token": "eyJ0eXAiOiJKV1QiL.....",
												        "name": "Admin"
												    },
												    "message": "User register successfully."
												}

 2) User Login
 	
 	Url : {Your_Path}/api/login
 	
 	Method - POST 
 	
 	Body : row
 	
 	Data : 

 			{
			    "email":"admin@gmail.com",
			    "password":"password"
			}

	The command will return the following format: 

		{"success":{"token":"eyJ0eXAiOiJKV1QiL..."}}

 Note : When you run each API please check the login , if login is available please use the token for authentication , if you do not have the token please login first in each API to receive the token and use the same token in each API with .

		Headers
		{
		"Authorization":"Bearer .$token"
		}

 3) Index

 	Url : {Your_Path}/api/phonebooks

 	Method - GET|HEAD 

 	Body : row

 	Data : Null


	The command will return the following format: 

							{
							    "success": true,
							    "data": [
							        {
							            "id": 1,
							            "firstName": "Laurie",
							            "lastName": "Kovacek",
							            "email": "kris.emily@example.com",
							            "mobileNumber": "09573975996",
							            "phoneNumber": "+1-606-729-9793",
							            "created_by": 1,
							            "updated_by": 1,
							            "created_at": "2021-09-03T12:54:26.000000Z",
							            "updated_at": "2021-09-03T12:54:26.000000Z"
							        },
							        {
							            ....
							        }
							    ],
							    "message": "Phone books retrieved successfully."
							}

4) Create

 	Url : {Your_Path}/api/phonebooks

 	Method - POST

 	Body : row

 	Data : 
 			
 			{
			    "firstName":"Parth",
			    "lastName":"Patel",
			    "email":"admin@gmail.com",
			    "mobileNumber":"07459169377"
			}

	The command will return the following format: 
	
		{"success":true,"data":{"firstName":"Parth","lastName":"Patel","email":"admin@gmail.com","mobileNumber":"07459169377","created_by":1,"updated_by":1,"updated_at":"2021-09-03T13:34:18.000000Z","created_at":"2021-09-03T13:34:18.000000Z","id":6},"message":"Phone book details stored successfully."}
 
 5) Read

 	Url : {Your_Path}/api/phonebooks/{phonebook}

 	Method - GET|HEAD

 	Body : row

 	Data : null


	The command will return the following format: 
	
		{"success":true,"data":{"id":6,"firstName":"Parth","lastName":"Patel","email":"webdeveloper.parth@gmail.com","mobileNumber":"07459169377","phoneNumber":"+1.934.506.1355","created_by":1,"updated_by":1,"created_at":"2021-09-03T13:34:18.000000Z","updated_at":"2021-09-03T14:00:41.000000Z"},"message":"Phone book details retrieved successfully."}

6) Edit

 	Url : {Your_Path}/api/phonebooks/{phonebook}

 	Method - PUT|PATCH

 	Body : row

 	Data : 

 			{
			    "firstName":"Parth",
			    "lastName":"Patel",
			    "email":"webdeveloper.parth@gmail.com",
			    "mobileNumber":"07459169377",
			    "phoneNumber" : "+1.934.506.1355"
			}

	The command will return the following format: 
	
			{"success":true,"data":{"id":6,"firstName":"Parth","lastName":"Patel","email":"webdeveloper.parth@gmail.com","mobileNumber":"07459169377","phoneNumber":"+1.934.506.1355","created_by":1,"updated_by":1,"created_at":"2021-09-03T13:34:18.000000Z","updated_at":"2021-09-03T14:00:41.000000Z"},"message":"Phone book updated successfully."}

7) Delete

 	Url : {Your_Path}/api/phonebooks/{phonebook}

 	Method - DELETE

 	Body : row

 	Data : null

	The command will return the following format: 

		{"success":true,"message":"Phone book deleted successfully."}


## Postman 
	
	https://github.com/parth11991/Lightflows/blob/main/postman_collection/Laravel-Test-Api.postman_collection.json
