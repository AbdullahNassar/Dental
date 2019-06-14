<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/lang/{locale}', ['as' => 'site.lang', 'uses' => 'LangController@postIndex']);
Route::group(['namespace' => 'Site'], function () {
    Route::get('/', ['as' => 'site.home', 'uses' => 'HomeController@getIndex']);
    Route::get('/services', ['as' => 'site.services', 'uses' => 'ServicesController@getIndex']);
    Route::get('/service/{id}', ['as' => 'site.service', 'uses' => 'ServicesController@getService']);
    Route::get('/team', ['as' => 'site.team', 'uses' => 'TeamController@getIndex']);
    Route::get('/posts', ['as' => 'site.posts', 'uses' => 'BlogController@getIndex']);
    Route::get('/post/{id}', ['as' => 'site.post', 'uses' => 'BlogController@getPost']);
    Route::get('/about', ['as' => 'site.about', 'uses' => 'AboutController@getIndex']);
    Route::get('/contact', ['as' => 'site.contact', 'uses' => 'ContactController@getIndex']);
    Route::post('/send', ['as' => 'site.message', 'uses' => 'ContactController@message']);
    Route::post('/comment', ['as' => 'site.comment', 'uses' => 'BlogController@comment']);
    Route::get('/gallery', ['as' => 'site.gallery', 'uses' => 'GalleryController@getIndex']);
    Route::get('/gallery/{id}', ['as' => 'site.gallery.cat', 'uses' => 'GalleryController@getImg']);
    Route::get('/book', ['as' => 'site.book', 'uses' => 'HomeController@getBook']);
    Route::post('/book', ['as' => 'site.book', 'uses' => 'HomeController@postBook']);
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/', 'AuthController@getIndex');
        Route::get('/login', 'AuthController@getIndex');
        Route::post('/login', 'AuthController@postLogin')->name('admin.login');
        Route::get('/logout', 'AuthController@getLogout')->name('admin.logout');
    });

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@getIndex']);
        Route::get('/about', ['as' => 'admin.about', 'uses' => 'AboutController@getAbout']);
        Route::post('/about', ['as' => 'admin.about.post', 'uses' => 'AboutController@updateAbout']);
        Route::get('/contacts', ['as' => 'admin.contacts', 'uses' => 'ContactsController@getContacts']);
        Route::post('/contacts', ['as' => 'admin.contacts.update', 'uses' => 'ContactsController@updateContacts']);
        Route::get('/data', ['as' => 'admin.data', 'uses' => 'DataController@getData']);
        Route::post('/data', ['as' => 'admin.data.update', 'uses' => 'DataController@updateData']);

        Route::group(['prefix' => 'slider'], function () {
            Route::get('/', ['as' => 'admin.slider', 'uses' => 'SliderController@getIndex']);
            Route::get('/add', ['as' => 'admin.slider.add', 'uses' => 'SliderController@getAdd']);
            Route::post('/add', ['as' => 'admin.slider.add', 'uses' => 'SliderController@insertSlider']);
            Route::get('/edit/{id}', ['as' => 'admin.slider.edit', 'uses' => 'SliderController@getSlider']);
            Route::post('/edit/{id}', ['as' => 'admin.slider.edit', 'uses' => 'SliderController@updateSlider']);
            Route::get('/delete/{id}', ['as' => 'admin.slider.delete', 'uses' => 'SliderController@getSlid']);
            Route::post('/delete/{id}', ['as' => 'admin.slider.delete', 'uses' => 'SliderController@deleteSlid']);
        });
        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/', ['as' => 'admin.gallery', 'uses' => 'GalleryController@getIndex']);
            Route::get('/add', ['as' => 'admin.gallery.add', 'uses' => 'GalleryController@getAdd']);
            Route::post('/add', ['as' => 'admin.gallery.add', 'uses' => 'GalleryController@insertImage']);
            Route::get('/edit/{id}', ['as' => 'admin.gallery.edit', 'uses' => 'GalleryController@getGallery']);
            Route::post('/edit/{id}', ['as' => 'admin.gallery.edit', 'uses' => 'GalleryController@updateGallery']);
            Route::get('/delete/{id}', ['as' => 'admin.gallery.delete', 'uses' => 'GalleryController@getG']);
            Route::post('/delete/{id}', ['as' => 'admin.gallery.delete', 'uses' => 'GalleryController@deleteG']);
        });
        Route::group(['prefix' => 'services'], function () {
            Route::get('/', ['as' => 'admin.services', 'uses' => 'ServicesController@getIndex']);
            Route::get('/add', ['as' => 'admin.services.add', 'uses' => 'ServicesController@getAdd']);
            Route::post('/add', ['as' => 'admin.services.add', 'uses' => 'ServicesController@insertService']);
            Route::get('/edit/{id}', ['as' => 'admin.service.edit', 'uses' => 'ServicesController@getService']);
            Route::post('/edit/{id}', ['as' => 'admin.service.edit', 'uses' => 'ServicesController@updateService']);
            Route::get('/delete/{id}', ['as' => 'admin.service.delete', 'uses' => 'ServicesController@getServ']);
            Route::post('/delete/{id}', ['as' => 'admin.service.delete', 'uses' => 'ServicesController@deleteServ']);
            Route::get('/data', ['as' => 'admin.service.data', 'uses' => 'ServicesController@getData']);
            Route::post('/data', ['as' => 'admin.service.data.edit', 'uses' => 'ServicesController@updateData']);
        });
        Route::group(['prefix' => 'doctors'], function () {
            Route::get('/', ['as' => 'admin.doctors', 'uses' => 'DoctorsController@getIndex']);
            Route::get('/add', ['as' => 'admin.doctor.add', 'uses' => 'DoctorsController@getAdd']);
            Route::post('/add', ['as' => 'admin.doctor.add', 'uses' => 'DoctorsController@insertDoctor']);
            Route::get('/edit/{id}', ['as' => 'admin.doctor.edit', 'uses' => 'DoctorsController@getDoctor']);
            Route::post('/edit/{id}', ['as' => 'admin.doctor.edit', 'uses' => 'DoctorsController@updatePackage']);
            Route::get('/delete/{id}', ['as' => 'admin.doctor.delete', 'uses' => 'DoctorsController@getDoc']);
            Route::post('/delete/{id}', ['as' => 'admin.doctor.delete', 'uses' => 'DoctorsController@deleteDoctor']);
        });
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', ['as' => 'admin.posts', 'uses' => 'PostsController@getIndex']);
            Route::get('/add', ['as' => 'admin.post.add', 'uses' => 'PostsController@getAdd']);
            Route::post('/add', ['as' => 'admin.post.add', 'uses' => 'PostsController@insertPost']);
            Route::get('/edit/{id}', ['as' => 'admin.post.edit', 'uses' => 'PostsController@getPost']);
            Route::post('/edit/{id}', ['as' => 'admin.post.edit', 'uses' => 'PostsController@updatePost']);
            Route::get('/delete/{id}', ['as' => 'admin.post.delete', 'uses' => 'PostsController@getP']);
            Route::post('/delete/{id}', ['as' => 'admin.post.delete', 'uses' => 'PostsController@deleteP']);
        });
        Route::group(['prefix' => 'stories'], function () {
            Route::get('/', ['as' => 'admin.stories', 'uses' => 'StoriesController@getIndex']);
            Route::get('/add', ['as' => 'admin.story.add', 'uses' => 'StoriesController@getAdd']);
            Route::post('/add', ['as' => 'admin.story.add', 'uses' => 'StoriesController@insertStory']);
            Route::get('/edit/{id}', ['as' => 'admin.story.edit', 'uses' => 'StoriesController@getStory']);
            Route::post('/edit/{id}', ['as' => 'admin.story.edit', 'uses' => 'StoriesController@updateStory']);
            Route::get('/delete/{id}', ['as' => 'admin.story.delete', 'uses' => 'StoriesController@getS']);
            Route::post('/delete/{id}', ['as' => 'admin.story.delete', 'uses' => 'StoriesController@deleteS']);
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', ['as' => 'admin.users', 'uses' => 'UsersController@getIndex']);
            Route::get('/add', ['as' => 'admin.user.add', 'uses' => 'UsersController@getAdd']);
            Route::post('/add', ['as' => 'admin.user.add', 'uses' => 'UsersController@insertUser']);
            Route::get('/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UsersController@getUser']);
            Route::post('/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UsersController@updateUser']);
            Route::get('/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'UsersController@getU']);
            Route::post('/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'UsersController@deleteU']);
        });
        Route::get('/message', ['as' => 'admin.message', 'uses' => 'MessageController@getIndex']);
        Route::get('/reservation', ['as' => 'admin.reservation', 'uses' => 'ReservationController@getIndex']);
        Route::post('/upload', ['as' => 'admin.upload.post', 'uses' => 'UploadController@getPost']);
        Route::post('/upload/images', ['as' => 'admin.upload.images', 'uses' => 'UploadController@getPostImages']);
    });
});