@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ Card ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('modal_add') }} {{ $title }}</h5>
                        </div>
                        <div class="card-block">
                            <a href="{{ route($route . '.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                {{ __('btn_back') }}</a>

                            <a href="{{ route($route . '.create') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i>
                                {{ __('btn_refresh') }}</a>
                        </div>

                        <div class="card-block">
                            <form class="needs-validation" novalidate action="{{ route($route . '.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="row">
                                        <!-- Form Start -->
                                        <div class="form-group col-md-4">
                                            <label for="name">{{ __('field_name') }} <span>*</span></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name') }}" required>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_name') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="phone">{{ __('field_phone') }}</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                value="{{ old('phone') }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_phone') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="email">{{ __('field_email') }}</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ old('email') }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_email') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="date">{{ __('field_date') }} <span>*</span></label>
                                            <input type="date" class="form-control date" name="date" id="date"
                                                value="{{ date('Y-m-d') }}" required>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_date') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="follow_up_date">{{ __('field_next_follow_up_date') }}</label>
                                            <input type="date" class="form-control date" name="follow_up_date"
                                                id="follow_up_date" value="{{ old('follow_up_date') }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_next_follow_up_date') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="assigned">{{ __('field_assigned') }}</label>
                                            <select class="form-control select2" name="assigned" id="assigned">
                                                <option value="">{{ __('select') }}</option>
                                                @foreach ($users as $assigned)
                                                    <option value="{{ $assigned->id }}"
                                                        @if (old('assigned') == $assigned->id) selected @endif>
                                                        {{ $assigned->staff_id }} - {{ $assigned->first_name }}
                                                        {{ $assigned->last_name }}</option>
                                                @endforeach
                                            </select>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_assigned') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="address">{{ __('field_address') }}</label>
                                            <textarea class="form-control" name="address" id="address">{{ old('address') }}</textarea>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_address') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="note" class="form-label">{{ __('field_note') }}</label>
                                            <textarea class="form-control" name="note" id="note">{{ old('note') }}</textarea>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="reference">{{ __('field_reference') }}</label>
                                            <select class="form-control" name="reference" id="reference">
                                                <option value="">{{ __('select') }}</option>
                                                @foreach ($references as $reference)
                                                    <option value="{{ $reference->id }}"
                                                        @if (old('reference') == $reference->id) selected @endif>
                                                        {{ $reference->title }}</option>
                                                @endforeach
                                            </select>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_reference') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="source">{{ __('field_source') }}</label>
                                            <select class="form-control" name="source" id="source">
                                                <option value="">{{ __('select') }}</option>
                                                @foreach ($sources as $source)
                                                    <option value="{{ $source->id }}"
                                                        @if (old('source') == $source->id) selected @endif>
                                                        {{ $source->title }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_source') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="program">{{ __('field_program') }} <span>*</span></label>
                                            <select class="form-control" name="program" id="program" required>
                                                <option value="">{{ __('select') }}</option>
                                                @foreach ($programs as $program)
                                                    <option value="{{ $program->id }}"
                                                        @if (old('program') == $program->id) selected @endif>
                                                        {{ $program->title }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_program') }}
                                            </div>
                                        </div>
                                        <div id="followup-container" class="row">
                                            @php
                                                $oldPurposes = old('purpose') ?? [];
                                            @endphp
                                            @foreach ($oldPurposes as $index => $purpose)
                                                <div class="form-group col-md-4 followup-item">
                                                    <label
                                                        for="purpose_{{ $index }}">{{ __('field_followup') }}</label>
                                                    <textarea class="form-control" name="purpose[]" id="purpose_{{ $index }}" required>{{ $purpose }}</textarea>
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_followup') }}
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-followup w-100"
                                                        style="margin-top:5px;" data-index="{{ $index }}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                            @if (count($oldPurposes) == 0)
                                                <div class="form-group col-md-4 followup-item">
                                                    <label for="purpose_0">{{ __('field_followup') }}</label>
                                                    <textarea class="form-control" name="purpose[]" id="purpose_0" required></textarea>
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_followup') }}
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-followup w-100"
                                                        style="margin-top:5px;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4">
                                            <button type="button" class="btn btn-secondary" id="add-followup">
                                                <i class="fas fa-plus"></i> {{ __('add_more_followup') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                                {{ __('btn_save') }}</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- [ Card ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@section('page_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let followupIndex = $('#followup-container .followup-item').length;

            $('#followup-container').on('click', '.remove-followup', function() {
                if ($('#followup-container .followup-item').length > 1) {
                    $(this).closest('.followup-item').remove();
                } else {
                    alert('At least one followup is required.');
                }
            });

            $('#add-followup').on('click', function() {
                const newFollowup = $(`
            <div class="form-group col-md-4 followup-item">
                <label for="purpose_${followupIndex}">{{ __('field_followup') }}</label>
                <textarea class="form-control" name="purpose[]" id="purpose_${followupIndex}" required></textarea>
                <div class="invalid-feedback">
                    {{ __('required_field') }} {{ __('field_followup') }}
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-followup w-100" style="margin-top:5px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `);

                $('#followup-container').append(newFollowup);
                followupIndex++;
            });
        });
    </script>
@endsection
</div>
<!-- [ Card ] end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>
<!-- End Content-->



@endsection
