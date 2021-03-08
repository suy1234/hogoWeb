@if(!request()->has('exam'))
<div class="section page-exam-b2" id="page-exam-b2">
	<form>
		<div class="container">
			<h1 class="text-center text-uppercase">{{ @$data[1][0] }}</h1>
			<div class="row">
				<div class="col-sm-8 col-md-8 col-xs-12">
					<div class="exam-item">
						<div>
							{!! @$data[1][1] !!}
						</div>
						<div class="row" style="margin-top: 15px;">
							@if(!empty($data[1][2]['group_type_questions']))
								@foreach($data[1][2]['group_type_questions'] as $item)
									<div class="col-xs-4 item">
										<a href="{{ request()->url() }}?exam={{ $item['id'] }}" title="{{ $data[1][0] }} {{ $item['title'] }}">
											{{ $item['title'] }}
										</a>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-xs-12">
					<div class="exam-item">
						<h2>{{ @$data[2][0] }}</h2>
						<div class="row">
							@if(!empty($data[2][1]['group_type_questions']))
								@foreach($data[2][1]['group_type_questions'] as $item)
									<div class="col-xs-4 item">
										<a href="{{ request()->url() }}?exam={{ $item['id'] }}" title="{{ $data[1][0] }} {{ $item['title'] }}">
											{{ $item['title'] }}
										</a>
									</div>
								@endforeach
							@endif
						</div>
					</div>
					<div class="exam-item">
						{!! @$data[2][2] !!}
					</div>
				</div>
			</div>
		</div>
		<div class="content-note-exam text-center">
			{{ @$data[3][0] }}
		</div>
	</form>
</div>
@else
<div class="section page-exam-b2" id="page-exam-b2">
	<form id="form_exam" action="{{ route('api.exam.check', ['exam_id' => request()->exam]) }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="max_question_true" value="{{ @$data[0] }}">
		<div class="container">
			<h1 class="text-center text-uppercase">{{ @$data[1][0] }} {{ $data['questions'][0]['group_type']['title'] }}</h1>
			<div class="row">
				<div class="col-sm-8 col-md-8 col-xs-12">
					<div class="content-exam result-exam mt" id="result-exam">
						<h2 class="text-center">
							KẾT QUẢ LÀM BÀI <strong class="text-uppercase">{{ $data['questions'][0]['group_type']['title'] }}</strong>
						</h2>			
						<div id="exam-html"></div>
						<div>Kiểm tra lại đáp án đúng bên dưới!</div>
					</div>
					<div class="content-exam">
						<p class="text-center exam-time" data-max-question="35">
							Thời gian còn lại: <span id="countdown" class="timer">22:00</span>
						</p>
						@if(count($data['questions']))
							@foreach($data['questions'] as $key => $question)
								<div id="question{{ $question['id'] }}" data-id="{{ $question['id'] }}" data-key="{{ $key+1 }}" class="content-exam-item {{ $key == 0 ? 'active' : '' }}">
									<h2>Câu {{ $key+1 }}:</h2>
									{!! $question['content'] !!}
									<hr />
									<ul class="list-unstyled">
										@foreach($question['answers'] as $answer)
											<li>
												<div class="custom-control custom-checkbox custom-answer-{{ $answer['is_answer'] }}">
													<input type="checkbox" class="custom-control-input" name="answers[{{ $question['id'] }}][{{ $answer['id'] }}]" value="1" id="answer{{ $answer['id'] }}" data-answer="{{ $answer['is_answer'] }}">
													<label class="custom-control-label" for="answer{{ $answer['id'] }}">
														{{ $answer['title'] }}
													</label>
												</div>
											</li>
										@endforeach
									</ul>
								</div>
							@endforeach
						@endif
						<div class="confirm-exam mt">
							<div class="text-center">
								<button type="button" class="btn btn-exam btn-exam-back pull-left">
									Câu trước
								</button>
								<button type="button" class="btn btn-exam btn-exam-next pull-right">
									Câu tiếp theo
								</button>
								<button class="btn btn-success" id="submit" type="submit" name="submit">
										NỘP BÀI THI
									</button>
									<a class="btn btn-warning" id="reload-page" href="{{ request()->fullUrl() }}">THI LẠI</a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="confirm-exam" style="margin-top: 15px;">
						{!! @$data[2][2] !!}
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-xs-12">
					<div class="exam-item">
						@if(count($data['questions']))
							@foreach($data['questions'] as $key => $question)
								<div class="item">
									<a href="javascript:void(0)" class="exam-item-question {{ $key == 0 ? 'active' : '' }}" data-id="{{ $question['id'] }}" data-key="{{ $key+1 }}">
										Câu {{ $key+1 }}
									</a>
								</div>
							@endforeach
						@endif
						<div class="clearfix"></div>
					</div>
					<div class="exam-item">
						<h2>{{ @$data[2][0] }}</h2>
						<div class="row">
							@if(!empty($data[2][1]['group_type_questions']))
								@foreach($data[2][1]['group_type_questions'] as $item)
									<div class="col-xs-4 item">
										<a href="{{ request()->url() }}?exam={{ $item['id'] }}" title="{{ $data[1][0] }} {{ $item['title'] }}">
											{{ $item['title'] }}
										</a>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-note-exam text-center">
			{{ @$data[3][0] }}
		</div>
	</form>
</div>
@endif
@push('script')
<script type="text/javascript">
		$(document).ready(function(){
			if($('#page-exam-b2').length){
				$('#page-exam-b2').on('click', '.exam-item-question', function(event) {
					event.preventDefault();
					var question = 'question'+$(this).attr('data-id');
					$('.exam-item-question').removeClass('active');
					$(this).addClass('active');

					$('.content-exam-item').removeClass('active');
					$('#'+question).addClass('active');
				});
				$('#page-exam-b2').on('click', '.btn-exam-next', function(event) {
					event.preventDefault();
					btn_exam_pagination('+');
				});
				$('#page-exam-b2').on('click', '.btn-exam-back', function(event) {
					event.preventDefault();
					btn_exam_pagination('-');
				});
				$('#form_exam').on("submit", function(event){
					event.preventDefault();
					$.ajax({
				     	url: $(this).attr('action'),
				      	type: 'post',
				      	data: $(this).serialize(),
				      	dataType: 'json',
				      	success: function(res) { 
				      		var text_color = res.success ? 'text-success' : 'text-danger';
				      		$.each(res.data, function(index, val) {
				      			var parent = $('#question'+index);
				      			if(!val.has_check){
				      				$('.page-exam-b2 .exam-item .item a[data-id='+index+']').addClass('exam-error');
				      			}
				      			
				      			for (var i = 0; i < val.answers.length; i++) {
				      			 	parent.find('#answer'+val.answers[i]).parent('.custom-control').css({
				      			 		background: '#1e7e34',
				      			 		color: '#FFFFFF',
				      			 	});
				      			}
				      		});
				      		var html = `
				         	<div>
								Số câu đúng: <strong class="`+text_color+`">`+res.total_question_true+`</strong>
							</div>
							<div>
								Số câu sai: <strong class="`+text_color+`">`+(res.total_question - res.total_question_true)+`</strong>
							</div>
							<div>
								Kết quả: <strong class="`+text_color+`">`+res.note+`</strong>
							</div>
							<div>
								Đáp án sai: <span style="color: red;">Tô màu đỏ</span>
							</div>
							<div>
								Đáp án đúng: <span style="color: blue;">Tô màu xanh</span>
							</div>`;
							$('#result-exam #exam-html').html(html);
							$('#reload-page').css('display', 'inline-block');
							$('#submit').css('display', 'none');
							$('.exam-time').css('display', 'none');
							$('#result-exam').addClass('active');

				     	}
				    });
				});
				$('#page-exam-b2').on('change', '.content-exam-item input', function(event) {
					event.preventDefault();
					var parent_id = $(this).parents('.content-exam-item').attr('data-id');
					
					var array_input = $(this).parents('.content-exam-item').find('input');
					var has_checked = false;
					$.each(array_input, function(index, val) {
						if(this.checked) {
							has_checked = true;
							return false;
						}
					});
					if(has_checked) {
						$('.exam-item-question[data-id='+parent_id+']').addClass('exam-active');
					}else{
						$('.exam-item-question[data-id='+parent_id+']').removeClass('exam-active');
					}
				});
			}
		});
		function btn_exam_pagination(cal){
			var key = $('.exam-item-question.active').attr('data-key');
			if(key != undefined){
				key = (cal == '-') ? (parseInt(key) - 1) : (parseInt(key) + 1);
				if( key >= 1 && key <= parseInt($('.exam-time').attr('data-max-question'))){
					$('.exam-item-question[data-key='+key+']').trigger('click');
				}
			}
		}
	</script>
@endpush