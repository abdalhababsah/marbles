<!--begin::Action-->
<td class="text-end">
{{--    <a class="btn btn-sm btn-light btn-active-light-primary edit_btn" id="{{$user->id}}" title="Edit"--}}
{{--       href="#"--}}
{{--       data-kt-user-id="{{ $user->id }}"--}}
{{--       data-bs-toggle="modal"--}}
{{--       data-bs-target="#kt_modal_add_user"--}}
{{--       data-kt-action="update_row">--}}
{{--        <i class="fad fa-edit text-hover-primary fa-xl"></i>--}}
{{--    </a>--}}
    <a class="btn btn-sm btn-light btn-active-light-danger remove_btn" id="{{$user->id}}" title="Delete"
       href="#"
       data-kt-user-id="{{ $user->id }}"
       data-kt-action="delete_row">
        <i class="fad fa-trash-alt text-hover-danger fa-xl"></i>
    </a>
</td>
<!--end::Action-->
