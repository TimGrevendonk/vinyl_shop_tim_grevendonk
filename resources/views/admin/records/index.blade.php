<h1>Records</h1>
<h2>with php</h2>
<ul>
    <?php
        foreach ($records as $key => $record) {
            echo "<li>Record $key= $record</li>";
        }
    ?>
</ul>
    <hr>
<h2>with .blade</h2>
<ul>
<!--    .blade uses double {} to encapsulate variables with data -->
{{--    the variables will not be red underlined like in php calls--}}
    @foreach($records as $key => $record)
        <li>Record {{$key}}= {{$record}}</li>
    @endforeach
    <hr>
{{--    this kind of .blade encapsulation wil NOT escape html data--}}
    @foreach($records as $key => $record)
        <li>Record {{$key}}= {!! $record !!}}}</li>
    @endforeach
</ul>
