

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
										</div>
									</div>


							</li>
						</ul>

					</div>
				</div>


	@endforeach
