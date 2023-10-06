<div class="bg-white py-8 lg:py-16 antialiased">
    @if(session('feedback.success'))
    <div class="flex mx-auto justify-center bg-gray-200 sm:w-2/5 w-1/2 p-3">
        <p style="color: green" class="flex justify-center">{{ session('feedback.success') }}</p>
    </div>
    @endif
    <div class="max-w-2xl mx-auto px-4" wire:click="closeModal">
        <div class="flex justify-between items-center mb-6">
            <x-post.commentcontent :post="$post"></x-post.commentcontent>
        </div>
        <form action="{{ route('post.comment.save', ['postId' => $post->id]) }}" class="mb-6" method="post">
            @csrf
            <div class="p-2 mb-4 bg-white">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" name='comment' rows="6" class="px-2 w-full text-sm text-gray-900 border-1 rounded-lg border-gray-200 focus:ring-lime-500 focus:border-lime-500 focus:ring-0 focus:outline-none" placeholder="Write a comment for {{ $post->user->name }}" required></textarea>
            </div>
            @if (session()->has('delete.success'))
            <div class="alert alert-success">
                {{ session('delete.success') }}
            </div>
            @endif
            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-lime-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                Post comment
            </button>
        </form>
        @foreach($post->comments as $comment)
        @php $errorVarName = "error_{$comment->id}"; @endphp
        @if (session()->has($errorVarName))
        <x-alert.success>{{ session($errorVarName) }}</x-alert.success>
        @endif
        <x-post.reply :post="$post" :comment="$comment"></x-post.reply>
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const countDown = document.getElementsByClassName('myTextarea');
        const length = document.getElementsByClassName('charCount');
        const maxLength = 140;
        for(let i = 0; i < countDown.length; i++){
        countDown[i].addEventListener('input', () => {
            length[i].textContent = maxLength - countDown[i].value.length;
            if (maxLength - countDown[i].value.length < 0) {
                length[i].style.color = 'red';
            } else {
                length[i].style.color = '#444';
            }
        }, false);
    }
</script>