<div class="row">
    <div class="col-md-12">
        <div class="form-group @if ($errors->has('title')) has-error @endif">
            <label class="col-sm-4 control-label" for="inputName">Title</label>
            <div class="col-sm-8">
                {!! Form::text('title', $post->title, ['placeholder' => 'Title', 'class' => 'form-control']) !!}
                @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
            </div>
        </div>

        <div class="form-group @if ($errors->has('content')) has-error @endif">
            <label class="col-sm-4 control-label" for="inputName">Content</label>
            <div class="col-sm-8">
                {!! Form::textarea('content', $post->content, ['rows' => 6, 'placeholder' => 'Content', 'class' => 'form-control']) !!}
                @if ($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
            </div>
        </div>

        <hr/>

        <div class="form-group @if ($errors->has('category_id')) has-error @endif">
            <label class="col-sm-4 control-label" for="inputName">Category</label>
            <div class="col-sm-8">
                {!! Form::select('category_id', $categories_list, $post->category_id, ['class' => 'form-control']) !!}
                @if ($errors->has('category_id')) <p class="help-block">{{ $errors->first('category_id') }}</p> @endif
            </div>
        </div>

        @if (Auth::user()->isAdmin())
            <div class="form-group @if ($errors->has('author_id')) has-error @endif">
                <label class="col-sm-4 control-label" for="inputName">Author</label>
                <div class="col-sm-8">
                    {!! Form::select('author_id', $authors_list, $post->author_id, ['class' => 'form-control']) !!}
                    @if ($errors->has('author_id')) <p class="help-block">{{ $errors->first('author_id') }}</p> @endif
                </div>
            </div>
        @endif

        @if (isset($_GET['location']))
            {!! Form::hidden('location', $_GET['location']) !!}
        @endif  

    </div>
</div>