<div class="col-md-3 talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	<!-- <div class="col-md-12"> -->
		<a href="" class="btn btn-default btn-outline btn-xs pull-right" type="button"><i class="fa fa-times"></i></a>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#talent-body" data-toggle="tab">Photo</a>
			</li>
			<li>
				<a href="#like-it-note" data-toggle="tab">My Notes</a>
			</li>
		</ul>
	<!-- </div>	 -->

	<div class="panel">
		<div class="panel-body">
			<div class="row-fluid clearfix">
				<div class="tab-content padding-top-zero padding-bottom-small">
					<div class="tab-pane fade active in" id="talent-body">
						<div class="head-area padding-zero padding-bottom-zero col-md-12">
							<div class="talent-name font-size-normal text-semibold float-left text-succes"><span data-bind="<%= getTalent().bam_talentci.getFullName() %>"></span>, <span data-bind="<%= getTalent().bam_talentci.getAge() %>" class="age-area"></span></div>
								<div class="favorite-indicator float-right">
								<i class="fa fa-star-o font-size-medium-large text-light-gray"></i>
							</div>
						</div>
						<div class="row-fluid clearfix">
							<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
								<img data-bind="<%= getTalent().bam_talentci.getPrimaryPhoto() %>" class="img-responsive" />
							</div>

							<div class="col-lg-6 col-md-12 col-sm-12 padding-right-zero talent-information padding-top-small">
								<div class="talent-location">
									<i class="fa fa-map-marker"></i> <span data-bind="<%= getTalent().bam_talentci.stateText() %>"></span>
								</div>

								<ul class="list-unstyled talents-list-details">
									<li><span data-bind="<%= getTalent().bam_talentci.heightText() %>"></span></li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo1.weightpounds %>"></span> lbs.</li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo2.ethnicity %>"></span></li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo1.build %>"></span></li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo1.eyecolor %>"></span></li>
								</ul>
							</div>
						</div>
						<div class="tab-pane" id="tab-content-2">
							<div class="item-container-holder">
								<div class="talent-item note-item-container padding-small">
									<div class="note-item">
										<div class="note-header">
											<div class="photo"></div>
											<div class="name-date">
												<div class="name">John Snow</div>
												<div class="date">09/20/2015</div>
											</div>
										</div>
										<div class="note-body">
											Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.
										</div>
									</div>
									<div class="note-item">
										<div class="note-header">
											<div class="photo"></div>
												<div class="name-date">
													<div class="name">Arya Stark</div>
													<div class="date">010/05/2015</div>
												</div>
										</div>
										<div class="note-body">
											Quisque velit nisi, pretium ut lacinia in, elementum id enim. Proin eget tortor risus. Nulla porttitor accumsan tincidunt.
										</div>
									</div>
								</div>
							</div>
							<a href="#"><div class="add-casting-note padding-top-small padding-bottom-small bordered text-align-center"><i class="fa fa-plus"></i> Add Casting Note</div></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid clearfix">
				<div class="col-md-6 padding-zero">
					<div class="like-it-list-container">
						<div class="text-left">
							<div class="display-block title"> Add to like list </div>
							<div class="btn-group btn-group-xs">
								<button class="btn btn-xs btn-danger disabled" data-rating="1">1</button>
								<button class="btn btn-xs btn-warning disabled" data-rating="2">2</button>
								<button class="btn btn-xs btn-info disabled" data-rating="3">3</button>
								<button class="btn btn-xs btn-primary disabled" data-rating="4">4</button>
								<button class="btn btn-xs btn-success disabled" data-rating="5">5</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 padding-zero">
					<div class="like-it-list-container">
						<div class="float-right-md-lg">
							<div class="display-block title">&nbsp;</div>
							<div class="btn-group btn-group-xs">
								<button class="btn btn-xs btn-default " data-rating="1"><span class="fa fa-file-text-o"></span></button>
								<button class="btn btn-xs btn-default " data-rating="2"><span class="fa fa-picture-o"></span></button>
								<button class="btn btn-xs btn-default " data-rating="1"><span class="fa fa-calendar"></span></button>
								<button class="btn btn-xs btn-default " data-rating="2"><span class="fa fa-envelope-o"></span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid clearfix margin-top-small">
				<div class="col-md-12 padding-zero">
					<a href="" class="btn btn-default btn-block btn-outline"><i class="fa fa-envelope-o"></i> Send Message</a>
				</div>
			</div>
		</div>
	</div>
</div> {{-- talent item container --}}
