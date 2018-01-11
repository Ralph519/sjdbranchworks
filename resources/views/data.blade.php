
@foreach($createdtickets as $createdticket)

			<div class="card card-plain">
				<div class="card-content">

						<ul class="timeline">
								<li class="timeline">

									@if($createdticket->s_statusxx == 'C')
										<div class="timeline-badge success">
											<i class="material-icons">thumb_up</i>
										</div>
									@else
										<div class="timeline-badge danger">
											<i class="material-icons">card_travel</i>
										</div>
									@endif


									<div class="timeline-panel">
										<div class="timeline-heading">
											Created Date: <strong>{{date('m/d/Y', strtotime($createdticket->created_at))}}</strong>
											<br>
											Ticket No: <strong>{{ $createdticket->s_brnccode.$createdticket->s_trannmbr }}</strong>
											<br>
											Branch: <strong>{{$createdticket->branch->implode('s_brncname')}}</strong>
											<br>
											Issue: <strong>{{ $createdticket->ticketissues->first()->issuetype_desc }}</strong>
										</div>
										<div class="timeline-body">
											Subject: <strong>{{ $createdticket->issuesubject }}</strong>
											<h6>Issue:</h6>
											<span>{{ $createdticket->m_issuedesc }}</span>

											@if($createdticket->s_statusxx == 'C')
												<h6>resolution:</h6>
												<span>{{ $createdticket->m_resodesc }}</span>
											@else
												<h6>Ticket not yet resolved</h6>
											@endif

											@if($createdticket->s_assignto != '')
												<br>
												<br>
												<span class="pull-right">Assigned To: {{$createdticket->user->name}}</span>
												<br>
											@endif

											@if($createdticket->s_statusxx == 'C')
												@if(is_null($createdticket->rating))
													<br>
													<span> <a href="#" class="btn btn-primary" data-toggle="modal"
															data-id="{{$createdticket->id}}"
															data-ticketno="{{$createdticket->s_brnccode.$createdticket->s_trannmbr}}"
															data-subject="{{$createdticket->issuesubject}}"
															data-assignto="{{$createdticket->s_assignto}}"
															data-assigntoname="{{$createdticket->user->name}}"
															data-target="#ratingsModal" >Rate the action taken to resolve this ticket</a> </span>
												@else
													<div class="rating">
															<br>
															<span>Your Ticket Resolution Rate: </span>
															<?php
															switch ($createdticket->rating->rating) {
																case '5':
																?>
																	<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> - Five Stars</span>
																<?php
																	break;

																case '4':
																?>
																	<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i> - Four Stars</span>
																<?php
																	break;

																case '3':
																?>
																	<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i> - Three Stars</span>
																<?php
																	break;

																case '2':
																?>
																	<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i> - Two Stars</span>
																<?php
																	break;

																case '1':
																?>
																	<span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i> - One Star</span>
																<?php
																	break;

																default:
																	# code...
																	break;
															}
															?>

													</div>
												@endif
											@endif

										</div>
									</div>


							</li>
						</ul>

					</div>
				</div>

				<div class="modal fade" id="ratingsModal" role="dialog" tabindex="-1" style="display: none;">
		      <div class="modal-dialog">
		        <div class="modal-content">


		          <div class="modal-header">
		            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
		            <h4 class="modal-title">Rate the action taken to solve your ticket</h4>
		          </div>

							<div class="modal-body">
		            <form action="{{route('ticket-management.saveRatings')}}" method="POST" id="repParam">
		              <input type="hidden" name="_method" value="PUT">
		              <input type="hidden" name="_token" value="{{ csrf_token() }}">
									<p>Rate this Ticket No. <b><span id="modalTicketno">TicketNoToAssign</span></b></p>
									<p>Subject : <b> <span id="modalSubject">SubjectNamehere</span> </b> </p>
									<p>Resolved By : <b> <span id="modalAssignedTo">AssignedTohere</span> </b> </p>
		              <hr>
		              <div class="row">
		                <div class="col-md-12">

											<div class="rating">
	                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="0" data-size="xs">
													<input type="hidden" name="ticketid" id="ticketid">
													<input type="hidden" name="assignto" id="assignto">
	                    </div>

		                </div>
		            	</div>
		            <div class="modal-footer">
		              <button class="btn btn-danger btn-simple" data-dismiss="modal" type="button" name="button">Close</button>
		              <button class="btn btn-primary" type="submit">Submit</button>
		            </div>
		            </form>
		          </div>

		        </div>
		      </div>
		    </div>


	@endforeach
