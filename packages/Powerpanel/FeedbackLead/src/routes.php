<?php
Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('powerpanel/feedback-leads/', 'Powerpanel\FeedbackLead\Controllers\Powerpanel\FeedbackleadController@index')->name('powerpanel.feedback-leads.list');
    Route::get('powerpanel/feedback-leads/', 'Powerpanel\FeedbackLead\Controllers\Powerpanel\FeedbackleadController@index')->name('powerpanel.feedback-leads.index');
    
    Route::post('powerpanel/feedback-leads/get_list/', 'Powerpanel\FeedbackLead\Controllers\Powerpanel\FeedbackleadController@get_list')->name('powerpanel.feedback-leads.get_list');
   Route::get('/powerpanel/feedback-leads/ExportRecord', ['uses' => 'Powerpanel\FeedbackLead\Controllers\Powerpanel\FeedbackleadController@ExportRecord', 'middleware' => 'permission:feedback-leads-list']);
   Route::post('powerpanel/feedback-leads/DeleteRecord', 'Powerpanel\FeedbackLead\Controllers\Powerpanel\FeedbackleadController@DeleteRecord');
       
});
