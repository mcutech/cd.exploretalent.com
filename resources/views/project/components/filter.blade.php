<div class="col-md-12 refine-search-sidebar">
	<form id="role-filter-form" onsubmit="return false">
	<div class="panel panel-talents-search">
		<div class="panel-heading border-bottom-width-zero">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<span class="panel-title talents-refine-title">Refine Search</span>
		</div>

		<div class="panel-body form-horizontal">
			<div id="location-search-display" class="row">
				<label class="control-label pull-left padding-left-normal"><a id="location-search-display-btn" href="">United States</a> <span class="padding-left-small">or</span></label>
				<div class="col-md-4 margin-top-normal-zz-xs">
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
						<option value="Hartford, CT">Hartford, CT</option>
						<option value="Honolulu, HI">Honolulu, HI</option>
						<option value="Indianapolis, IN">Indianapolis, IN</option>
						<option value="Houston, TX">Houston, TX</option>
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
						<option value="New York, NY">New York, NY</option>
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
				<div class="col-md-3 margin-top-normal-zz-xs">
					<select name="distance" class="form-control">
						<option value="25">25 miles</option>
						<option value="50">50 miles</option>
						<option value="100">100 miles</option>
						<option value="150">150 miles</option>
						<option value="200">200 miles</option>
					</select>
				</div>
			</div>

			<div id="location-search-change" class="col-md-9" hidden >
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

			<div class="row">
				<div class="margin-top-small margin-bottom-small" id="selected-markets">
					<label data-bind-template="#selected-markets" class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Albany, NY</span>
					</label>
				</div>
			</div>

			<hr class="panel-wide margin-top-small-normal margin-bottom-small-normal">
			<div class="row margin-bottom-large">
				<div class="col-md-3">
					<label class="text-bold margin-bottom-zero">Age Range: <span id="age-min-text" data-bind="<%= age_min || 0 %>" class="text-normal">0</span> - <span id="age-max-text" class="text-normal" data-bind="<%= age_max %>">100</span></label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div data-range="true" data-values="[0, 100]" data-min="0" data-max="100" data-bind="[<%= age_min || 0 %>, <%= age_max %>]" data-type="age" data-slider></div>
						<input type="hidden" name="age_min" data-bind="<%= age_min || 0 %>" />
						<input type="hidden" name="age_max" data-bind="<%= age_max || 0 %>" />
					</div>
					</div>
				</div>
				<div class="col-md-3 margin-top-normal">
					<div id="genderForm">
						<label for="" class="checkbox-inline"><strong>Gender: </strong> <span id="selected">Any</span></label>
						<label class="checkbox-inline">
						<input type="checkbox" id="checkboxMale" name="sexMale" value="Male"> Male
						</label>
						<label class="checkbox-inline">
						<input type="checkbox" id="checkboxFemale" name="sexFemale" value="Female"> Female
						</label>
					</div>
					{{-- <select name="sex" class="form-control" data-select data-bind="<%= getGenders().length > 1 ? '' : getGenders()[0] %>"> --}}
					{{-- 	<option value="">Gender - Both</option> --}}
					{{-- 	<option value="Male">Male</option> --}}
					{{-- 	<option value="Female">Female</option> --}}
					{{-- </select> --}}
				</div>
				<div class="col-md-3 margin-top-normal">
					<select name="has_photo" class="form-control" data-select>
						<option value="">Picture - All</option>
						<option value="false">No Picture</option>
						<option value="true" selected>With Picture</option>
					</select>
				</div>
				<div class="col-md-3">
					<input id="search-text" name="search_text" class="form-control margin-top-normal" placeholder="Keyword..."></input>
				</div>
			</div>

			<div class="row margin-bottom-large">
				<div class="col-md-3">
					<label class="text-bold margin-bottom-zero">Height Range:
						<span id="height-min-text" class="text-normal" data-bind="<%= height_min ? getHeightMinText() : '< 2\'0&quot;' %>">&lt; 2'0"</span> -
						<span id="height-max-text" class="text-normal" data-bind="<%= height_max ? getHeightMaxText() : '8\'0&quot;' %>">8'0"</span>
					</label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height" data-bind="[<%= height_min ? height_min : 22 %>, <%= height_max ? height_max : 96 %>]"></div>
						<input type="hidden" name="height_min" data-bind="<%= height_min %>" />
						<input type="hidden" name="height_max" data-bind="<%= height_max %>" />
					</div>
					</div>
				</div>
				<div class="col-md-3 margin-top-normal">
					<select name="build" class="form-control" multiple data-select placeholder="Body Type - All" data-bind="<%= getBuilds().length == 9 ? '' : getBuilds().join('|') %>">
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
				<div class="col-md-3 margin-top-normal">
					<select name="ethnicity" class="form-control" multiple data-select placeholder="Ethnicity - All" data-bind="<%= getEthnicities().length == 12 ? '' : getEthnicities().join('|') %>">
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
				<div class="col-md-3 margin-top-normal">
					<select name="last_access" class="form-control" data-select>
						<option value="">Last Active - Any</option>
						<option value="2592000">Last Active - 1 month</option>
						<option value="7776000">Last Active - 3 months</option>
						<option value="15552000">Last Active - 6 months</option>
						<option value="31104000">Last Active - 1 year</option>
					</select>
				</div>
			</div>
			<div id="additional-filters" class="row margin-bottom-large hide">
				<div class="col-md-3">

				</div>
				<div class="col-md-3">
					<select name="favorite_talent" class="form-control" data-select>
						<option value="0">Favorites - Any</option>
						<option value="1">Favorite Talents</option>
					</select>
				</div>
				<div class="col-md-3">

				</div>
				<div class="col-md-3">

				</div>
			</div>
			<div class="row">
				<div class="col-md-3 pull-right margin-top-normal-zz-xs">
					<button id="search-button" type="submit" class="btn btn-primary btn-block">Filter Search</button>
				</div>
			</div>
		</div>
	</div>
	</form>
</div> {{-- refine-search-sidebar --}}
