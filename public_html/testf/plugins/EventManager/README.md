# EventManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/EventManager
```


01. events
02. event_bookings
03. event_documents
04. event_joins
05. transactions
06. transactions_event_bookings
07. event_reviews
08. event_invites
09. event_options
10. event_option_values
11. event_booking_options
12. event_booking_option_values


Step 1.

bin\cake bake plugin EventManager

Step 2.

Events
bin\cake bake migration -p EventManager createEvents user_id:integer[11]:INDEX title:string[255] short_description:string[400] description:text location:string[255] organizar_name:string[150] organizer_email:string[250] banner_image:string[255] amount:decimal max_participants:integer[11] start_date:datetime end_date:datetime meta_title:string[255] meta_keyword:string[255] meta_description:text is_join:boolean:INDEX is_register:boolean:INDEX is_paid:boolean:INDEX status:boolean created modified

Event Bookings
bin\cake bake migration -p EventManager createEventBookings event_id:integer[11]:INDEX coupon_id:integer[11]:INDEX first_name:string[150] last_name:string[150] email:string[150] mobile:string[16] address:string[255] amount:decimal discount:decimal total_amount:decimal created modified

Event Documents
bin\cake bake migration -p EventManager createEventDocuments event_id:integer[11]:INDEX file_type:boolean file_name:string[255] caption:string[255] sort_order:integer[11]:INDEX created modified

Event Joins
bin\cake bake migration -p EventManager createEventJoins event_id:integer[11]:INDEX  user_id:integer[11] ip_address:string[100] sessionId:string[255] created modified

Transactions
bin\cake bake migration -p EventManager createTransactions amount:decimal service_provider_amount:decimal payment_method:string[10] transaction_status:boolean transactionId:string[50] transaction_responce:text created modified

Transactions Event Bookings
bin\cake bake migration -p EventManager createTransactionsEventBookings event_booking_id:integer[11]:INDEX transaction_id:integer[11]:INDEX created modified

Event Reviews
bin\cake bake migration -p EventManager createEventReviews event_id:integer[11]:INDEX user_id:integer[11]:INDEX name:string[150] email:string[150] rating:integer[2] status:boolean created modified

Event Invites
bin\cake bake migration -p EventManager createEventInvites event_id:integer[11]:INDEX user_id:integer[11] sessionId:string[500] status_in:boolean created modified

Event Options
bin\cake bake migration -p EventManager createEventOptions event_id:integer[11]:INDEX option_id:integer[11] value:text required:boolean created modified

Event Option Values
bin\cake bake migration -p EventManager createEventOptionValues event_id:integer[11]:INDEX option_id:integer[11] event_option_id:integer[11] options_value_id:integer[11] option_value:text created modified

Event Booking Options
bin\cake bake migration -p EventManager createEventBookingOptions event_booking_id:integer[11]:INDEX option_id:integer[11] name:string[200] option_value:string[250] option_type:string[50] created modified

Event Booking Option Values
bin\cake bake migration -p EventManager createEventBookingOptionValues event_booking_option_id:integer[11]:INDEX opt_value:string[200]

Step3.

bin\cake migrations migrate -p EventManager


Step4.

bin\cake bake all --plugin EventManager events --prefix admin -t BackEnd  (this command use when you create new plugin)
bin\cake bake model --plugin EventManager event_documents (this command use when you create new plugin other model)