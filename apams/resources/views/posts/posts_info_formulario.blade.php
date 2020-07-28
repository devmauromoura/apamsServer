<div class="row">
	<div class="col-lg-6">
		<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
			<div class="card-body" style="padding: 1rem">
				<h5 class="card-title" style="margin-bottom: 0"><i class="far fa-thumbs-up"></i> {{ (isset($likes)) ? $likes : '0' }} <small>Curtidas</small></h5>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
			<div class="card-body" style="padding: 1rem">
				<h5 class="card-title" style="margin-bottom: 0"><i class="far fa-comment"></i> {{ (isset($ncomments)) ? $ncomments : '0' }} <small>Comentários</small></h5>
			</div>
		</div>
	</div>
</div>

<div class="list-group" style="max-height: 24.5rem;overflow: auto;">

	@if(isset($comments) && count($comments) > 0)
		@foreach ($comments as $item)
			<a href="javascript:;" class="list-group-item list-group-item-action flex-column align-items-start" style="pointer-events: none;">
				<div class="d-flex w-100 justify-content-between">
					<span class="mb-1"><b>{{ $item->name }}</b></span>
					<small class="text-muted">{{ (isset($item->created_at)) ? date('d/m/Y - H:i:s', strtotime($item->created_at)) : "00/00/00" }}</small>
				</div>
				<p class="mb-1" style="font-size: 0.9rem;">{{ $item->comment }}</p>
			</a>
		@endforeach
	@else
		<a href="javascript:;" class="list-group-item list-group-item-action flex-column align-items-start" style="pointer-events: none;">
			<div class="d-flex w-100 justify-content-center">
				<span>Sem comentários</span>
			</div>
		</a>
	@endif
	
</div>

<script>

	console.log(@json($comments))

	console.log(@json($likes))

</script>