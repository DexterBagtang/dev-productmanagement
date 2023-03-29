@component('mail::message')
    Good Day, <br>
{{$actionMessage}} <br>
    Project title: {{$project_title}}

@component('mail::button', ['url' => 'pm.philcom.com'])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
