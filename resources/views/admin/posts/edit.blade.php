@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Titolo</label>
                {{-- @error('title') is-invalid @enderror --}}
                <input type="text" class="form-control" id="title" placeholder="Inserisci il titolo dell'articolo" name="title" value="{{ old('title', $post->title )}}">
                {{-- @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror --}}
            </div>
            <div class="form-group">
                <label for="content">Testo</label>
                {{-- @error('content') is-invalid @enderror --}}
                <textarea class="form-control " id="content" rows="6" name="body" placeholder="Inserisci il testo dell'articolo">{{ old('body', $post->body) }}</textarea>
                {{-- @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror --}}
            </div>
            <div class="preview">
                @if ($post->cover)
                    <img src="{{asset('storage/'.$post->cover)}}" alt="">
                @endif
            </div>
            {{-- file upload --}}
            <div class="form-group">
                <label for="cover">Immagine di copertina</label>
                {{-- @error('cover') is-invalid @enderror --}}
                <input type="file" name="cover" class="form-control-file" id="cover">
                {{-- @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                @enderror --}}
            </div>
            {{-- /file upload --}}

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">-- Seleziona una categoria --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ ($category->id == old('category_id', $post->category_id)) ? 'selected' : '' }}
                            >{{ $category->name }}</option>
                    @endforeach
                </select>
                {{-- @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror --}}
            </div>  
            
             {{-- tags --}}
             <div class="form-group mb-5">
                <h5>Tags</h5>
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        @if ($errors->any())
                            <input class="form-check-input" name="tags[]" type="checkbox" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                            >
                        @else
                            <input class="form-check-input" name="tags[]" type="checkbox" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}
                            > 
                        @endif
                        
                        <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>     
                @endforeach 
                {{-- @error('tags')
                    <div>
                        <small class="text-danger">{{ $message }}</small> 
                    </div>
                @enderror    --}}
            </div>    
            {{-- /tags --}}

            <button type="submit" class="btn btn-primary">Modifica</button>
            <a class="btn btn-secondary ml-2" href="{{ route('admin.posts.index') }}">Elenco Post</a>
        </form>
    </div>


@endsection