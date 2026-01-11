<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <p>Current Odometer: {{ $car->odometer_current }}</p>
    <p>Previous Odometer: {{ $car->odometer_previous }}</p>
    <p>Previous Oil Change Date: {{ $car->date_previous }}</p>
    <p>Submission Date: {{  $car->created_at }}</p>

    <!-- Condition: more than 5000 km since last oil change
        or more than 6 months since the last oil change
        (assuming 6 months from submission date so results page doesn't change over time) -->
    @if (($car->odometer_current - $car->odometer_previous) > 5000 
    || $car->date_previous->diffInMonths($car->created_at) > 6)
        <p>The car is due for an oil change.</p>
    @else
        <p>The car is not due for an oil change.</p>
    @endif


    <a href="{{ route('home') }}">Back to form</a>
</div>
