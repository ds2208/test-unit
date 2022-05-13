import { Button, Container, Form, FormControl, Nav, Navbar, Offcanvas } from 'react-bootstrap';

function Header(props: HeaderProps) {

    return (
        <>
            {
                <Navbar fixed="top" bg="dark" variant='dark' expand={false}>
                    <Container fluid>
                        <Navbar.Brand href="/">
                            Color CRUD
                        </Navbar.Brand>
                        <Navbar.Toggle aria-controls="offcanvasNavbar-expand" />
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
                                            <Nav.Link key={item.id} href={item.link}>{item.name}</Nav.Link>
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
            }
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
