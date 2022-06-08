import { Button, Container, Form, FormControl, Nav, Navbar, Offcanvas } from 'react-bootstrap';
import { ToastContainer } from 'react-toastify';
import { Link } from 'react-router-dom';

function Header(props: HeaderProps) {
    return (
        <>
            <ToastContainer />
            <Navbar fixed="top" bg="dark" variant='dark' expand={false}>
                <Container fluid>
                    <Navbar.Brand>
                        <Link to="/" className="text-light">
                            Color CRUD
                        </Link>
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="offcanvasNavbar-expand show" />
                    <Navbar.Offcanvas
                        id="offcanvasNavbar-expand"
                        aria-labelledby="offcanvasNavbarLabel-expand"
                        placement="end"
                    >
                        <Offcanvas.Header closeButton className='bg-secondary text-light'>
                            <Offcanvas.Title id="offcanvasNavbarLabel-expand">
                                Navigation
                            </Offcanvas.Title>
                        </Offcanvas.Header>
                        <Offcanvas.Body className='bg-dark'>
                            <Nav className="justify-content-end flex-grow-1 pe-3">
                                {
                                    props.navItems.map(item => {
                                        return (
                                            <Link key={item.id} to={item.link} className="text-light">
                                                {item.name}
                                            </Link>
                                        )
                                    })
                                }
                            </Nav>
                            <Form className="d-flex">
                                <FormControl
                                    type="search"
                                    placeholder="Search"
                                    className="me-2"
                                    aria-label="Search"
                                />
                                <Button variant="outline-success">Search</Button>
                            </Form>
                        </Offcanvas.Body>
                    </Navbar.Offcanvas>
                </Container>
            </Navbar>
        </>
    );
}

type HeaderProps = {
    navItems: {
        id: number,
        name: string,
        link: string
    }[]
};

export default Header;
