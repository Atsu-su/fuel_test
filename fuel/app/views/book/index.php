<h3>index page</h3>
<table class = "table">
   <thead>
      <tr>
         <th>#</th>
         <th>Title</th>
         <th>Author_ID</th>
         <th>Published_Date</th>
         <th>Description</th>
      </tr>
   </thead>

   <tbody>
      <?php
         foreach($books as $book) {
      ?>

      <tr>
         <td><?php echo $book->id; ?></td>
         <td><?php echo $book->title; ?></td>
         <td><?php echo $book->author->name; ?></td>
         <td><?php echo $book->published_date; ?></td>
         <td><?php echo $book->description; ?></td>
         <td>
            <a href="<?php echo Uri::create('book/edit/'.$book->id); ?>">Edit</a>
            <a href="<?php echo Uri::create('book/delete/'.$book->id); ?>">Delete</a>
         </td>
      </tr>

      <?php
      }
      ?>
   </tbody>
</table>