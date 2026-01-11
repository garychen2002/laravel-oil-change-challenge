<!-- Car Form -->
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/check">
                    @csrf
                    <div class="form-control w-full">
                        Current Odometer (km):
                        <input type="number"
                            name="odometer_current"
                            placeholder=""
                            required
                        ></input>
                    </div>
 
                    <div class="form-control w-full">
                        Date of Previous Oil Change:
                        <input type="date"
                            name="date_previous"
                            placeholder=""
                            required
                        ></input>
                    </div>

                    <div class="form-control w-full">
                        Odometer at Previous Oil Change (km):
                        <input type="number"
                            name="odometer_previous"
                            placeholder=""
                            required
                        ></input>
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>