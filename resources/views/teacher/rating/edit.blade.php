@extends('layout.master') 
@section('content')
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Rate Teacher</h3>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if ($errors->any())
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger" style="color:red">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="card">
                        <div class="card-body">
                            <div style="color:green">
                                {{ session()->get('message') }}
                            </div><br/>
                        </div>
                    </div> 
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <p class="text-dark">
                                Thank you for taking your time to rate our teacher, <span class="text-primary">{{$teacher->name}} {{$teacher->surname}}</span>.<br />
                                <small>Note that your name will <b>not</b> appear to the teacher but the admin team may wish to contact you to address any issues raised.</small>
                            </p>
                            {!! Form::open(['action' => ['TeacherRatingsController@update', $rating->id], 'method'=>'PUT']) !!}
                                <div class="form-group row">
                                    {{Form::label('score', 'Score', ['class'=>'col-lg-4 col-form-label'])}}
                                    <div style="display:none">
                                        {{Form::number('score', $rating->score, ['class' => 'form-control col-lg-6', 'required', 'min'=>'1', 'max'=>'5', 'id' => 'score'])}}
                                    </div>
                                    @for ($i = 0; $i < $rating->score; $i++)
                                        <span id="{{$i}}" class="fa fa-star text-warning"></span>
                                    @endfor
                                    @for ($i = 5; $i > $rating->score; $i--)
                                        <span id="{{$i}}" class="fa fa-star"></span>
                                    @endfor
                                </div>
                                <div class="form-group row">
                                    {{Form::label('comment', 'Comment', ['class'=>'col-lg-4 col-form-label'])}}
                                    {{Form::textarea('comment', $rating->comment, ['class' => 'form-control col-lg-6', 'placeholder' => 'Enter comment..', 'required', 'style'=>'height:100%', 'maxlength' => '255'])}}
                                </div>
                                {{Form::hidden('teacher_id', $teacher->id)}}
                                <div class="form-group row">
                                    {{Form::submit('Update', ['class' => 'btn btn-primary btn-block '])}}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extraJS')
    <script>
        $(document).ready(function(){
            $(".fa-star").hover(function() {
                var id = $( this ).attr("id");
                
                for (let index = id; index >= 0; index--) {
                    $('#'+index).addClass('text-warning');
                }
                
                for (let index = 4; index > id; index--) {
                    $('#'+index).removeClass('text-warning');
                }
            });

            $(".fa-star").click(function() {
                var id = $(this).attr("id");
                $("#score").val(parseInt(id)+1);
            });
        });
    </script>

        <script src="js/lib/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="js/lib/bootstrap/js/popper.min.js"></script>
        <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/jquery.slimscroll.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>


        <!-- Form validation -->
        <script src="js/lib/form-validation/jquery.validate.min.js"></script>
        <script src="js/lib/form-validation/jquery.validate-init.js"></script>
        <!--Custom JavaScript -->
        <script src="js/scripts.js"></script>
@endsection