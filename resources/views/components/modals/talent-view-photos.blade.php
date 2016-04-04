<div class="modal fade" id="talent-view-photos-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span data-bind="<%= getFullName() %>, <%= getAge() %>"></span></h4>
      </div>
      <div class="modal-body">
		<div id="carousel-custom" class="carousel slide" data-ride="carousel" data-interval="false" data-pause="true" keyboard="true">
		    <div class="carousel-outer">
		        <!-- Wrapper for slides -->
		        <div id="carousel-inner" class="carousel-inner">
		            <div data-bind-template="#carousel-inner" data-bind-value="bam_talent_media2" class="item">
		               <img data-bind="https://etdownload.s3.amazonaws.com/<%= bam_media_path_full %>">
		            </div>
		        </div>
		            
		        <!-- Controls -->
		        <a class="left carousel-control" href="#carousel-inner" data-slide="prev">
		            <span class="glyphicon glyphicon-chevron-left"></span>
		        </a>
		        <a class="right carousel-control" href="#carousel-inner" data-slide="next">
		            <span class="glyphicon glyphicon-chevron-right"></span>
		        </a>
		    </div>
		    
		    <!-- Indicators -->
		    <ol id="carousel-indicators" class="carousel-indicators mCustomScrollbar">
		    	<li data-bind-template="#carousel-indicators" data-bind-value="bam_talent_media2" data-target="#carousel-custom">
		    		<img class="thumbnail-size" data-bind="https://etdownload.s3.amazonaws.com/<%= bam_media_path_full %>">
		    	</li>
		    </ol>
		        {{-- <li data-target="#carousel-talent-photos" data-slide-to="0" class="active"><img class="thumbnail-size" src="http://placehold.it/100x50&text=slide1" alt=" /></li> --}} 	
        </div>
      </div>
    </div>
  </div>
</div>