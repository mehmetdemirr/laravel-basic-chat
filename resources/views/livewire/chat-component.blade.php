<div>
    @foreach ($convo as $convoItem)
        {{ $convoItem["username"] }} : {{ $convoItem["message"] }}
        <br>
    @endforeach
    <form wire:submit="submitMessage">
        <x-text-input wire:model="message" wire:key="{{ now() }}"/> 
        <button type="submit">send</button>
    </form>
</div>
