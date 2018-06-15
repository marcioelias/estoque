@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Alterar de Usuário e Perfil de Acesso', 
            'routeUrl' => route('role_user.update', $roleUser->id), 
            'method' => 'PUT',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Save', 'icon' => 'ok'],
                ['type' => 'button', 'label' => 'Cancel', 'icon' => 'remove']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'select',
                            'field' => 'role_id',
                            'label' => 'Perfil',
                            'required' => true,
                            'items' => $roles,
                            'inputSize' => 6,
                            'displayField' => 'display_name',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => $roleUser->role_id
                        ],
                        [
                            'type' => 'select',
                            'field' => 'user_id',
                            'label' => 'Usuário',
                            'required' => true,
                            'items' => $users,
                            'inputSize' => 6,
                            'displayField' => 'name',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => $roleUser->user_id
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection