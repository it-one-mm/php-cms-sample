 <!-- jQuery -->
 <script src="js/jquery.js"></script>

 <script>
    $(document).ready(function(){

            $('#select-all-boxes').click(function(event){
    
                if(this.checked) {

                    $('.checkBoxes').each(function(){

                        this.checked = true;

                    });

                } else {


                    $('.checkBoxes').each(function(){

                        this.checked = false;

                    });


                }

            });
        });
     </script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
