<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">

			<?php

			if ($_SESSION["perfil"] == "Administrador") {

				echo '<li class="active">

					<a href="inicio">

						<i class="fa fa-home"></i>
						<span>Inicio</span>

					</a>

				</li>

				<li>

					<a href="usuarios">

						<i class="fa fa-user"></i>
						<span>Usuarios</span>

					</a>

				</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {

				echo '<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>

			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Contador") {

				echo '<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Contador") {

				echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>';

				if ($_SESSION["perfil"] == "Administrador") {

					echo '<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';
				}



				echo '</ul>

			</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Contador") {

				echo '<li class="treeview">

						<a href="#">

							<i class="fa fa-calculator"></i>
							
							<span>Contabilidad</span>
							
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>
						
						<ul class="treeview-menu">
							
							<li>

								<a href="contabilidad">
									
									<i class="fa fa-circle-o"></i>
									<span>Contabilidad</span>

								</a>

							</li>

							<li>

								<a href="gastos">
									
									<i class="fa fa-circle-o"></i>
									<span>Gastos</span>

								</a>

							</li>

							<li>

								<a href="crear-gastos">
									
									<i class="fa fa-circle-o"></i>
									<span>Crear gastos</span>

								</a>

							</li>

							<li>

								<a href="entradas">
									
									<i class="fa fa-circle-o"></i>
									<span>Entradas</span>

								</a>

							</li>

							<li>

								<a href="crear-entradas">
									
									<i class="fa fa-circle-o"></i>
									<span>Crear entradas</span>

								</a>

							</li>
							
						</ul>
					</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Contador" || $_SESSION["perfil"] == "Vendedor") {
				echo '<li class="treeview">

						<a href="#">

							<i class="fa fa-clipboard"></i>
							
							<span>Cotizaciones</span>
							
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>
						
						<ul class="treeview-menu">
							
							<li>

								<a href="cotizacion">
									
									<i class="fa fa-circle-o"></i>
									<span>Administrar COTIZ.</span>

								</a>

							</li>

							<li>

								<a href="crear-cotizacion">
									
									<i class="fa fa-circle-o"></i>
									<span>Crear cotizacion</span>

								</a>

							</li>
							
						</ul>
					</li>';
			}

			?>

		</ul>

	</section>

</aside>