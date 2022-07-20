
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign project to the user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form" method='post'>
        @csrf
          <div class="form-group">
            Project:- {{$project['title']}}<br>
            <label for="recipient-name" class="col-form-label">Select user to assign project:</label>
           
            <select class="form-control" name="userId[]" multiple size=5>
              
               
                   @foreach($users as $user)
                      @if(in_array($user->id, $selected_user))  
                        <option value='{{$user->id}}' selected>{{$user->name}}</option>
                      @else
                        <option value='{{$user->id}}'>{{$user->name}}</option>    
                      @endif  
                    @endforeach
               
            </select>
            @error('userId')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
          </div>
          <div class="form-group">
            
        
            <input type="hidden" id="projectId" name='projectId' value="{{ $project['id']}}">
            
          </div>
        <div id="message" class='text-danger'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  id="assign_btn">Assign project</button>
     


      </div>
      </form>
    </div>
  </div>
</div>