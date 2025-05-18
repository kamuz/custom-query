<?php
if ( ! empty( $_GET['type'] ) ) {
	$type = $_GET['type'];
} else {
	$type = '';
}
if ( ! empty( $_GET['search'] ) ) {
	$search = $_GET['search'];
} else {
	$search = '';
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="custom-search">
	<form action="/search">
		<input type="search" name="search" placeholder="Search..." value="<?php echo $search; ?>">
		<label for="type">Post Type:</label>
		<select name="type" id="type">
			<option value="">Any</option>
			<option value="post" <?php echo ( $type == 'post' ) ? 'selected' : ''; ?>>Post</option>
			<option value="movie" <?php echo ( $type == 'movie' ) ? 'selected' : ''; ?>>Movie</option>
		</select>
		<input type="submit" value="Search">
	</form>
</div>