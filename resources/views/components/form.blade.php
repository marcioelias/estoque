@php
    $btnAlign = isset($btnAlign) ? $btnAlign : 'Right';
    $btnColor = ['submit' => 'success', 'reset' => 'danger', 'button' => 'danger'];
    $fileUpload = (isset($fileUpload) && $fileUpload) ? 'enctype=multipart/form-data' : '';
@endphp

@if($title != '')
    <div class="panel-heading"><h3>{{__($title)}}</h3></div>
@endif
<div class="panel-body">
    {{-- <p>Fields with <span class="label label-pill label-success">*</span> are required.</p> --}}
    <form class="form" {{isset($formTarget) ? 'target='.$formTarget : ''}} role="form" method="POST" action="{{$routeUrl}}" {{$fileUpload}}>
        {{ csrf_field() }}

        @if(isset($method))
            @if($method != 'POST')
                <input name="_method" type="hidden" value="{{$method}}">
            @endif
        @endif

        @yield('formFields')

        {{--  <hr>  --}}

        <div class="form-group">
            <div class="{{ ($btnAlign == 'Right') ? 'pull-right' : '' }}">
                @if(is_array($formButtons)) 
                    @foreach($formButtons as $formButton)
                        @if(($formButton['type'] == 'submit') || ($formButton['type'] == 'reset'))
                            <button type="{{$formButton['type']}}" class="btn btn-{{$btnColor[$formButton['type']]}}" data-toggle="tooltip" data-placement="top" title="{{ __($formButton['label']) }}" data-original-title="{{ __($formButton['label']) }}">
                                @if(isset($formButton['icon']))
                                    <span class="glyphicon glyphicon-{{$formButton['icon']}}"></span>
                                @else
                                    {{ __($formButton['label']) }}
                                @endif
                            </button>
                        @else
                            <a href="{{ url()->previous() }}" class="btn btn-{{$btnColor[$formButton['type']]}}"  data-toggle="tooltip" data-placement="top" title="{{ __($formButton['label']) }}" data-original-title="{{ __($formButton['label']) }}">
                                @if(isset($formButton['icon']))
                                    <span class="glyphicon glyphicon-{{$formButton['icon']}}"></span>
                                @else
                                    {{ __($formButton['label']) }}
                                @endif
                            </a>
                        @endif
                    @endforeach
                @else
                    <button type="submit" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="{{ __($formButton['label']) }}" data-original-title="{{ __($formButton['label']) }}">
                        @if(isset($formButton['icon']))
                            <span class="glyphicon glyphicon-{{$formButton['icon']}}"></span>
                        @else
                            {{ __($formButton['label']) }}
                        @endif
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>