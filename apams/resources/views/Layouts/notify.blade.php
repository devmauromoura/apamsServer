<script>
    @if(session()->has('success'))
		$.notify({
			message: '{{ session()->get('success') }}' 
		},{
			type: 'success'
		});
	@elseif(session()->has('danger'))
		$.notify({
			message: '{{ session()->get('danger') }}' 
		},{
			type: 'danger'
		});
	@endif
</script>