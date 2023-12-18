<form method="post" action="{{route('student.store')}}">
  @csrf
  <label>First Name</label>
  <input type="text" name="fName"/>
  
  <label>Last Name</label>
  <input type="text" name="lName"/>
  <input type="submit" value="Submit" name="Submit"/>
</form>