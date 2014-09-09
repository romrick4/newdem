<?php include 'include_header.php'; ?>
<?php
$query = $db->getQuery(true);

                $query->select("p.*, CONCAT(p.photo_id, '_', p.photo_name) real_photo_name");
                $query->select("p.*, photo_caption");
                $query->select("sum(l.like_type) like_sum ");
                $query->from('#__photos p');
                $query->innerJoin("#__likes l on l.photo_id = p.photo_id");
                $query->where("YEARWEEK(l.like_date) = YEARWEEK(CURDATE())");
                $query->group("l.photo_id");
                $query->order('like_sum DESC');
                $query->order('p.photo_caption');

                $db->setQuery($query);

                try{
                    $photos = $db->loadObjectList();
                } catch (Exception $e) {
                    die();
                }
                ?>
<body>
<div id="main">
			<div class="container">
				<div class="row"> 

					<!-- Sidebar -->
					<div id="sidebar" class="4u">
						<section>
							<header>
								<h2>Featuring</h2>
								<span>Photos Here</span>
							</header>
							<ul class="style">
								<li>
									<p class="posted">August 11, 2002  |  (10 )  Comments</p>
									<img src="images/pic04.jpg" alt="" />
									<p class="text">Nullam non wisi a sem eleifend. Donec mattis libero eget urna. Pellentesque viverra enim.</p>
								</li>
								<li>
									<p class="posted">August 11, 2002  |  (10 )  Comments</p>
									<img src="images/pic05.jpg" alt="" />
									<p class="text">Nullam non wisi a sem eleifend. Donec mattis libero eget urna. Pellentesque viverra enim.</p>
								</li>
								<li>
									<p class="posted">August 11, 2002  |  (10 )  Comments</p>
									<img src="images/pic06.jpg" alt="" />
									<p class="text">Nullam non wisi a sem eleifend. Donec mattis libero eget urna. Pellentesque viverra enim.</p>
								</li>
								<li>
									<p class="posted">August 11, 2002  |  (10 )  Comments</p>
									<img src="images/pic05.jpg" alt="" />
									<p class="text">Nullam non wisi a sem eleifend. Donec mattis libero eget urna. Pellentesque viverra enim.</p>
								</li>
							</ul>
						</section>
					</div>
					
					<!-- Content -->
					<div id="content" class="8u skel-cell-important">
						<section>
							<header>
								<h2>Trending Photos</h2>
								<span class="byline">Most popular pictures of the week!</span>
							</header>
							<?php
			if(isset($_SESSION["message"])){
			echo $_SESSION["message"];
			unset($_SESSION["message"]);
			}
			?>
            <?php if (!empty($photos)) : ?>
                <?php foreach ($photos as $photo) : ?>
                    <div class="well" style="width: 700px">
                    <h3><a href="<?php echo $photo->photo_path . $photo->real_photo_name; ?>" target="_blank" style="text-decoration: none; color: #000000;"><strong><?php echo $photo->photo_caption ?></strong></a></h3>
                    <img id="photo_<?php echo $photo->photo_id;?>" class="img-thumbnail" src="<?php echo $photo->photo_path . $photo->real_photo_name; ?>" style="width: 500px; box-shadow: 8px 8px 5px #888888;"/>
                    <div>
                        <h4>
                            <a href="likes.php?photo_id=<?php echo $photo->photo_id; ?>&amp;like_type=1" type="button" style="box-shadow: 4px 4px 5px #888888;" class="button">Like</a>
                            <a href="likes.php?photo_id=<?php echo $photo->photo_id; ?>&amp;like_type=-1" type="button" style="box-shadow: 4px 4px 5px #888888;" class="button">Dislike</a>
                        </h4>
                    </div>
                        </div>
                <?php endforeach; ?>
            <?php endif; ?>
						</section>
					</div>
					
				</div>
			</div>
		</div>

		<!-- Footer -->
		<div id="featured">
			<div class="container">
				<div class="row">
					<div class="4u">
						<h2>Aenean elementum facilisis</h2>
						<a href="#" class="image full"><img src="images/pic01.jpg" alt="" /></a>
						<p>Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Quisque dictum. Pellentesque viverra vulputate enim.</p>
						<p><a href="#" class="button">More Details</a></p>
					</div>
					<div class="4u">
						<h2>Fusce ultrices fringilla</h2>
						<a href="#" class="image full"><img src="images/pic02.jpg" alt="" /></a>
						<p>Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Quisque dictum. Pellentesque viverra vulputate enim.</p>
						<p><a href="#" class="button">More Details</a></p>
					</div>
					<div class="4u">
						<h2>Etiam rhoncus volutpat erat</h2>
						<a href="#" class="image full"><img src="images/pic03.jpg" alt="" /></a>
						<p>Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Quisque dictum. Pellentesque viverra vulputate enim.</p>
						<p><a href="#" class="button">More Details</a></p>
					</div>
				</div>
			</div>
		</div>
		</body>
		</html>

<?php include 'include_footer.php'; ?>