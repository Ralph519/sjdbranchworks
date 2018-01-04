

@foreach($createdtickets as $createdticket)

			<div class="card card-plain">
				<div class="card-content">

						<ul class="timeline">
							@if($createdticket->id % 2 == 0)
								<li class="timeline">
							@else
									<li class="timeline-inverted">
							@endif
									<div class="timeline-badge danger">
										<i class="material-icons">card_travel</i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<span class="label label-danger">{{ $createdticket->s_brnccode.$createdticket->s_trannmbr }}</span>
										</div>
									<div class="timeline-body">
										<p>{{ $createdticket->issuesubject }}</p>
										<h3><a href="">{{ $createdticket->s_brnccode.$createdticket->s_trannmbr }}</a></h3>
										<p>{{ str_limit($createdticket->issuesubject, 400) }}</p>
									</div>
								</div>
							</li>
						</ul>

					</div>
				</div>

	@endforeach
