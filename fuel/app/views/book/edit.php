<style>
   #form table {
      width: 90%;
   }
   #form table tr {
      width: 90%
   }
   #form table tr td {
      width: 50%
   }
   #form input[type = text], select, textarea {
      width: 100%;
      padding: 12px 20px;
      margin: 15px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
   }
   #form input[type = submit] {
      width: 100%;
      background-color: #3c3c3c;
      color: white;
      padding: 14px 20px;
      margin: 15px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
   }
   #form div {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
   }
</style>
<?php if (isset($errors)): ?>
    <?php foreach ($errors as $field => $error): ?>
        <p style="color: red;"><?php echo $field.': '.$error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<div id="form">
	<form action="<?php echo Uri::create('book/modify/'.$book->id) ?>" accept-charset="utf-8" method="post">
		<table>
            <tr>
                <td class=""><label id="label_title" for="form_title">Book title</label>*</td>
                <td class=""><input type="text" id="form_title" name="title" value="<?php echo isset($input) ? $input['title'] : $book->title ?>" /> <span></span> </td>
            </tr>
            <tr>
                <td class=""><label id="label_published_date" for="form_published_date">Published Date</label>*</td>
                <td class=""><input type="date" id="form_published_date" name="published_date" value="<?php echo isset($input) ? $input['published_date'] : $book->published_date ?>" /> <span></span> </td>
            </tr>
            <tr>
                <td class=""><label id="label_description" for="form_description">Book description</label>*</td>
                <td class=""><textarea id="form_description" name="description"><?php echo isset($input) ? $input['description'] : $book->description ?></textarea> <span></span> </td>
            </tr>
            <tr>
                <td class=""><label id="label_author_id" for="form_author_id">author_id</label></td>
                <td class="">
                    <select id="form_author_id" name="author_id">
                        <option value="">Select Author</option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?php echo $author->id ?>" <?php echo isset($input) && $input['author_id'] == $author->id ? 'selected' : ($book->author_id == $author->id ? 'selected' : ''); ?>><?php echo $author->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class=""></td>
                <td class=""><input type="submit" value="変更" id="form_Submit" name="Submit" /> <span></span> </td>
            </tr>
		</table>
	</form>
</div>