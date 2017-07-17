<div class="col-md-12 refine-search-sidebar">
	<form id="talent-filter-form" onsubmit="return false">
	<input type="hidden" id="address-search" name="address_search" value="1" />
	<div class="panel panel-talents-search">
		<div class="panel-heading border-bottom-width-zero">
			<span class="panel-title talents-refine-title">Refine Search</span>
			<button type="button" class="close hide" data-dismiss="modal" aria-hidden="true">×</button>
		</div>
		<div class="panel-body form-horizontal">
			<ul class="nav nav-tabs">
				<li role="presentation">
					<a data-toggle="tab" class="tabs" role="tab" href="#market-search">Search by Market</a>
					<input type="hidden" value="0" />
				</li>
				<li role="presentation" class="active">
					<a  class="tabs" data-toggle="tab" data-search-by="locations" role="tab" href="#location-search">Search by Location</a>
					<input type="hidden" value="1" />
				</li>				
			</ul>
		</div>		
		<div class="tab-content padding-zero">
			<div role="tabpanel" class="tab-pane fade form-horizontal" id="market-search">
				<div id="location-search-display" class="col-md-9 padding-zero-zz-sm">
					<label class="control-label pull-left padding-left-normal"><a id="location-search-display-btn" href="">United States</a> <span class="padding-left-small">or</span></label>
					<div class="col-md-3 margin-top-normal-zz-sm">
						<select id="markets-list" name="markets" class="form-control" tabindex="-1" data-select multiple data-bind="<%= bam_casting.market.split('>').join('|') %>">
							<option> </option>
							<option value="Albany, NY">Albany, NY</option>
							<option value="Albuquerque, NM">Albuquerque, NM</option>
							<option value="Atlanta, GA">Atlanta, GA</option>
							<option value="Augusta, ME">Augusta, ME</option>
							<option value="Baltimore, MD">Baltimore, MD</option>
							<option value="Billings, MT">Billings, MT</option>
							<option value="Birmingham, AL">Birmingham, AL</option>
							<option value="Boise, ID">Boise, ID</option>
							<option value="Boston, MA">Boston, MA</option>
							<option value="Buffalo, NY">Buffalo, NY</option>
							<option value="Charleston, SC">Charleston, SC</option>
							<option value="Charleston, WV">Charleston, WV</option>
							<option value="Charlotte, NC">Charlotte, NC</option>
							<option value="Chicago, IL">Chicago, IL</option>
							<option value="Cleveland, OH">Cleveland, OH</option>
							<option value="Columbia, SC">Columbia, SC</option>
							<option value="Columbus, OH">Columbus, OH</option>
							<option value="Dallas, TX">Dallas, TX</option>
							<option value="Denver, CO">Denver, CO</option>
							<option value="Des Moines, IA">Des Moines, IA</option>
							<option value="Detroit, MI">Detroit, MI</option>
							<option value="El Paso, TX">El Paso, TX</option>
							<option value="Fargo, ND">Fargo, ND</option>
							<option value="Grand Junct, CO">Grand Junct, CO</option>
							<option value="Harford, CT">Harford, CT</option>
							<option value="Honolulu, HI">Honolulu, HI</option>
							<option value="Houston, TX">Houston, TX</option>
							<option value="Indianapolis, IN">Indianapolis, IN</option>
							<option value="Jackson, MS">Jackson, MS</option>
							<option value="Jacksonville, FL">Jacksonville, FL</option>
							<option value="Kansas City, KS">Kansas City, KS</option>
							<option value="Kansas City, MO">Kansas City, MO</option>
							<option value="Las Vegas, NV">Las Vegas, NV</option>
							<option value="Little Rock, AR">Little Rock, AR</option>
							<option value="Los Angeles, CA">Los Angeles, CA</option>
							<option value="Louisville, KY">Louisville, KY</option>
							<option value="Memphis, TN">Memphis, TN</option>
							<option value="Miami, FL">Miami, FL</option>
							<option value="Milwaukee, WI">Milwaukee, WI</option>
							<option value="Minneapolis, MN">Minneapolis, MN</option>
							<option value="Nashville, TN">Nashville, TN</option>
							<option value="New Orleans, LA">New Orleans, LA</option>
							<option value="New York City, NY">New York City, NY</option>
							<option value="Norfolk, VA">Norfolk, VA</option>
							<option value="Oklahoma City, OK">Oklahoma City, OK</option>
							<option value="Omaha, NE">Omaha, NE</option>
							<option value="Orlando, FL">Orlando, FL</option>
							<option value="Philadelphia, PA">Philadelphia, PA</option>
							<option value="Phoenix, AZ">Phoenix, AZ</option>
							<option value="Pittsburgh, PA">Pittsburgh, PA</option>
							<option value="Portland, ME">Portland, ME</option>
							<option value="Portland, OR">Portland, OR</option>
							<option value="Raleigh, NC">Raleigh, NC</option>
							<option value="Rapid City, SD">Rapid City, SD</option>
							<option value="Reno, NV">Reno, NV</option>
							<option value="St Louis, MO">St Louis, MO</option>
							<option value="Salt Lake City, UT">Salt Lake City, UT</option>
							<option value="San Antonio, TX">San Antonio, TX</option>
							<option value="San Diego, CA">San Diego, CA</option>
							<option value="San Francisco, CA">San Francisco, CA</option>
							<option value="Seattle, WA">Seattle, WA</option>
							<option value="Tampa, FL">Tampa, FL</option>
							<option value="Washington, DC">Washington, DC</option>
							<option value="Wichita, KS">Wichita, KS</option>
							<option value="All Markets">All Markets</option>
							<option value="Calgary-Edm, AB">Calgary-Edm, AB</option>
							<option value="Ottawa, ON">Ottawa, ON</option>
							<option value="Montreal, QC">Montreal, QC</option>
							<option value="Toronto, ON">Toronto, ON</option>
							<option value="Vancouver, BC">Vancouver, BC</option>
						</select>
					</div>	
					<div class="col-xs-12 col-md-2 margin-top-normal-zz-sm">
						<button id="search-button" name="market_search_btn" type="submit" class="btn btn-primary btn-block search-button">Search</button>
					</div>				
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade in active" id="location-search">
				<div class="col-md-12 padding-zero-zz-sm">
					<div class="col-md-5 margin-top-normal-zz-sm">
						<label class="control-label">Search Address</label>
						<input id="location-search-box" type="text" name="locations" class="form-control" placeholder="Enter Address" />
						<div class="margin-top-normal">
							Distance from point <input type="text" value="5" id="place-miles-in" class="form-control" style="display: inline-block; width: 12%" readonly="readonly" /> Miles
						</div>		
						<div class="margin-top-normal">
							<div id="place-miles" data-range="false" data-step="5" data-type="miles" data-slider></div>
						</div>	
						<div class="col-md-4 margin-top-medium padding-zero">
							<button type="submit" id="location_search_btn" name="location_search_btn" class="btn btn-primary btn-block search-button">Search</button>
						</div>			
					</div>
					<div class="col-md-7 margin-top-normal-zz-sm">
					<div id="location-filter-map" style="height: 200px"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body form-horizontal">
			<div class="row text-center-zz-sm">				

				<div id="location-search-change" class="col-md-9 padding-zero-zz-sm" hidden >
					<div class="col-md-12 search-result-counter">
						<div class="hide bordered no-border-vr border-left-width-zero display-inline-block padding-right-normal margin-right-normal-sm-lg border-zero-zz-sm">
							<h2 class="margin-zero text-bold">5,000</h2>
						</div>
						<div class="location-name display-inline-block">
							<h3 class="margin-zero"><span class="text-default">All United States Markets</span></h3>
						</div>
						<div class="change-location-button display-inline-block margin-left-normal margin-zero-zz-sm">
							<a href="" id="location-search-change-btn" class="text-bold"><i class="fa fa-chevron-right"></i> Change Location</a>
						</div>
					</div>
				</div>				
			</div>			

			<hr class="panel-wide margin-top-small-normal margin-bottom-small-normal">
			<div class="row margin-bottom-large">
				<div class="col-xs-12 col-sm-6 col-md-3">
					<label class="text-bold margin-bottom-zero">Age Range: <span class="text-normal">from</span>
						<input id="age-min-input" class="text-normal" style="width: 30px;" value="<3">
						<span class="text-normal">to</span>
						<input id="age-max-input" class="text-normal" style="width: 30px;" value="70+">
						<span class="text-normal">years</span>
					</label>
					<div class="padding-right-small">
						<div class="padding-small">
							<div id="age-range-slider" data-range="true" data-values="[2, 71]" data-min="2" data-max="71" data-type="age" data-slider></div>
							<input type="hidden" name="age_min" />
							<input type="hidden" name="age_max" />
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-6 margin-top-normal padding-zero">
					<div id="genderForm">
						<label for="" class="checkbox-inline padding-left-normal col-md-3"><strong>Gender: </strong><strong><span id="selected">Any</span></strong></label>
							<label class="checkbox-inline padding-zero">
							  	<input type="checkbox" id="checkboxMale" name="sexMale" value="Male"> Male
							</label>
							<label class="checkbox-inline padding-right-large">
							  	<input type="checkbox" id="checkboxFemale" name="sexFemale" value="Female"> Female
							</label>
						<label class="checkbox-inline">
					  		<input type="checkbox" id="has-photo" name="has_photo" checked="checked" value="true"><strong>With Picture</strong>
						</label>
					</div>
					{{-- <select name="has_photo" class="form-control" data-select> --}}
					{{-- 	<option value="true">With Picture</option> --}}
					{{-- 	<option value="false">No Picture</option> --}}
					{{-- </select> --}}
					{{-- <select name="sex" class="form-control" data-select> --}}
					{{-- 	<option value="">Gender - Both</option> --}}
					{{-- 	<option value="Male">Male</option> --}}
					{{-- 	<option value="Female">Female</option> --}}
					{{-- </select> --}}
				</div>
				<div class="col-xs-12 col-md-3">
					<div>
						<input id="search-text" name="search_text" class="form-control margin-top-normal" placeholder="Keyword..."></input>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-3">
					<label class="text-bold margin-bottom-zero">Height Range:
						<select id="height-min-dropdown">
							<?php
								$bool = false;
								for ($i = 22; $i <= 96; $i++) {
									$feet = floor($i / 12);
									$inches = $i % 12;

									if($i < 24) {
										if($bool == false) {
											echo "<option value=".$i."><2' 0\"</option>";
											$bool = true;
										}
									}
									else {
										echo "<option value=".$i.">".$feet."' ".$inches."\"</option>";
									}
								}
							?>
						</select>
						<span class="text-normal">to</span>
						<select id="height-max-dropdown">
							<?php
								$bool = false;
								for ($i = 22; $i <= 96; $i++) {
									$feet = floor($i / 12);
									$inches = $i % 12;

									if($i < 24) {
										if($bool == false) {
											echo "<option value=".$i."><2' 0\"</option>";
											$bool = true;
										}
									}
									else if($i == 96) {
										echo "<option value=".$i." selected>".$feet."' ".$inches."\"</option>";
									}
									else {
										echo "<option value=".$i.">".$feet."' ".$inches."\"</option>";
									}
								}
							?>
						</select>
					</label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div id="height-range-slider" class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height"></div>
						<input type="hidden" name="height_min" />
						<input type="hidden" name="height_max" />
					</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 margin-top-normal">
					<select name="build" class="form-control" multiple data-select placeholder="Body Type - All">
						<option value="Athletic">Athletic</option>
						<option value="Average">Average</option>
						<option value="Extra Large">Extra-Large</option>
						<option value="Large">Large</option>
						<option value="Lean Muscle">Lean-Muscle</option>
						<option value="Medium">Medium</option>
						<option value="Muscular">Muscular</option>
						<option value="Petite">Petite</option>
						<option value="Slim">Slim</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 margin-top-normal">
					<select name="ethnicity" class="form-control" multiple data-select placeholder="Ethnicity - All">
						<option value="African">African</option>
						<option value="African American">African American</option>
						<option value="American Indian">American Indian</option>
						<option value="Asian">Asian</option>
						<option value="Caucasian">Caucasian</option>
						<option value="Eastern Indian">Eastern Indian</option>
						<option value="Hispanic">Hispanic</option>
						<option value="Middle Eastern">Middle Eastern</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 margin-top-large">
					<a href="#" id="toggle-advanced-filters-btn" class="text-xs pull-right">Advanced Filters</a>
				</div>
			</div>
			<div id="advanced-filters-div" class="row margin-bottom-large" style="display: none;">
				<div class="col-xs-12 col-sm-6 col-md-3 margin-top-large">
					<select name="last_access" class="form-control" data-select>
						<option value="">Last Active - Any</option>
						<option value="2592000">Last Active - 1 month</option>
						<option value="7776000">Last Active - 3 months</option>
						<option value="15552000">Last Active - 6 months</option>
						<option value="31104000">Last Active - 1 year</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 margin-top-large">
					<select name="young_old" class="form-control" data-select>
						<option value="">Age - Default</option>
						<option value="ASC">Age - Oldest to Youngest</option>
						<option value="DESC">Age - Youngest to Oldest</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 margin-top-large">
					<select name="union" class="form-control" data-select>
						<option value="">Union - Any</option>
						<option value="1">Union - Union</option>
						<option value="0">Union - Non-Union</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	</form>
</div> {{-- refine-search-sidebar --}}
