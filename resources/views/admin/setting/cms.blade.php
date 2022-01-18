@extends('layouts.admin')
@section('title','CMS Setting')
@section('nav-title', 'CMS Setting')
@section('content')
<div class="container-fluid">
    <form method="post" action="{{route('admin.cms.store')}}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">General Cms</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone</label>
                                    <input type="text" value="{{$setting['phone'] ?? ''}}" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <input type="text" value="{{$setting['email'] ?? ''}}" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Web</label>
                                    <input type="text" value="{{$setting['web'] ?? ''}}" name="web" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Facebook</label>
                                    <input type="text" value="{{$setting['facebook'] ?? ''}}" name="facebook" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Instagram</label>
                                    <input type="text" value="{{$setting['instagram'] ?? ''}}" name="instagram" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Banner Section Cms</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Banner Heading</label>
                                    <input type="text" value="{{$setting['banner_heading'] ?? ''}}" name="banner_heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Banner Sub Heading</label>
                                    <input type="text" value="{{$setting['banner_sub_heading'] ?? ''}}" name="banner_sub_heading" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Who Web Are & What We Do Section</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Title</label>
                                    <input type="text" value="{{$setting['section_3_title'] ?? ''}}" name="section_3_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Description</label>
                                    <input type="text" value="{{$setting['section_3_description'] ?? ''}}" name="section_3_description" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">What We offer Section</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">First Card Title</label>
                                    <input type="text" value="{{$setting['section_4_first_title'] ?? ''}}" name="section_4_first_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">First Card Description</label>
                                    <textarea rows="2" cols="" name="section_4_first_description" class="form-control">{{$setting['section_4_first_description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Second Card Title</label>
                                    <input type="text" value="{{$setting['section_4_second_title'] ?? ''}}" name="section_4_second_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Second Card Description</label>
                                    <textarea rows="2" cols="" name="section_4_second_description" class="form-control">{{$setting['section_4_second_description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Third Card Title</label>
                                    <input type="text" value="{{$setting['section_4_third_title'] ?? ''}}" name="section_4_third_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Third Card Description</label>
                                    <textarea rows="2" cols="" name="section_4_third_description" class="form-control">{{$setting['section_4_third_description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">For Students and Parents Section</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">First Card Title</label>
                                    <input type="text" value="{{$setting['section_5_first_title'] ?? ''}}" name="section_5_first_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">First Card Description</label>
                                    <textarea rows="2" cols="" name="section_5_first_description" class="form-control">{{$setting['section_5_first_description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Second Card Title</label>
                                    <input type="text" value="{{$setting['section_5_second_title'] ?? ''}}" name="section_5_second_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Second Card Description</label>
                                    <textarea rows="2" cols="" name="section_5_second_description" class="form-control">{{$setting['section_5_second_description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Third Card Title</label>
                                    <input type="text" value="{{$setting['section_5_third_title'] ?? ''}}" name="section_5_third_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Third Card Description</label>
                                    <textarea rows="2" cols="" name="section_5_third_description" class="form-control">{{$setting['section_5_third_description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Questions About Hiring? Section</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Call Us (Contact)</label>
                                    <input type="text" value="{{$setting['call_us'] ?? ''}}" name="call_us" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Questions About Hiring?</label>
                                    <input type="text" value="{{$setting['question'] ?? ''}}" name="question" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Question Sub Heading</label>
                                    <input type="text" value="{{$setting['question_sub_heading'] ?? ''}}" name="question_sub_heading" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
      <a href="{{route('admin.dashboard')}}" class="btn btn-danger pull-right">Close</a>
    </form>
</div>
@endsection