<?php include 'include_header.php'; ?>
<?php

                $query = $db->getQuery(true);

                $query->select("p.*, CONCAT(p.photo_id, '_', p.photo_name) real_photo_name");
                $query->select("p.*, photo_caption");
                $query->from('#__photos p');
                $query->order('p.photo_id DESC');
                $query->order('p.photo_caption');


                $db->setQuery($query);

                try{
                    $photos = $db->loadObjectList();
                } catch (Exception $e) {
                    die();
                }

                $query = $db->getQuery(true);

                $query->select("p.*, user_username");
                $query->from('#__users p');
                $query->order('p.user_username');

                $db->setQuery($query);

                try{
                    $users = $db->loadObjectList();
                } catch (Exception $e) {
                    die();
                }

            ?>
<html>
	
	<body class="homepage">

		<!-- Header -->
		

		<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row"> 
					
					<!-- Content -->
					<div id="content" class="8u skel-cell-important">
						<section>
							<header>
								<h2>Newest Photos</h2>
								<span class="byline">Photos of all kinds here!</span>
							</header>
							<?php if (!empty($photos)) : ?>
			    <?php foreach ($photos as $photo) : ?>
                    <div class="well" style="width: 43.750em">
                        <h3><a href="<?php echo $photo->photo_path . $photo->real_photo_name; ?>" target="_blank" style="text-decoration: none; color: #000000;"><strong><?php echo $photo->photo_caption ?></strong></a></h3>
				    <img id="photo_<?php echo $photo->photo_id;?>" class="img-thumbnail" src="<?php echo $photo->photo_path . $photo->real_photo_name; ?>" style="width: 500px; box-shadow: 8px 8px 5px #888888;"/>
                    <div>
                        <h4>
                            <a href="likes.php?photo_id=<?php echo $photo->photo_id; ?>&amp;like_type=1" type="button" style="box-shadow: 4px 4px 5px #888888;" class="button">Like</a>
                            <a href="likes.php?photo_id=<?php echo $photo->photo_id; ?>&amp;like_type=-1" type="button" style="box-shadow: 4px 4px 5px #888888;" class="button">Dislike</a>
                            <a href="#comment_modal" data-toggle="modal" type="button" style="box-shadow: 4px 4px 5px #888888;" class="button">Comment</a>

                        </h4>
                    </div>
                    
                    </div>
			    <?php endforeach; ?>
            <?php endif; ?>
						</section>
					</div>
					
					<!-- Sidebar -->
					<div id="sidebar" class="4u">
						<section>
							<header>
								<h2>Pellentesque vulputate</h2>
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
							</ul>
						</section>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		


		<!-- Footer -->
		

		<!-- Copyright -->
		
		
	</body>
</html>
<?php include 'include_footer.php'; ?>