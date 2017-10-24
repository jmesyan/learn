Ginkgo hooks into Go’s existing testing infrastructure. This allows you to run a Ginkgo suite using go test.
````
This also means that Ginkgo tests can live alongside traditional Golang testing tests. Both go test and ginkgo will run all the tests in your suite.
Bootstrapping a Suite
````
To write Ginkgo tests for a package you must first bootstrap a Ginkgo test suite. Say you have a package named books:

$ cd path/to/books
$ ginkgo bootstrap
This will generate a file named books_suite_test.go containing:
````
package books_test

import (
    . "github.com/onsi/ginkgo"
    . "github.com/onsi/gomega"
    "testing"
)

func TestBooks(t *testing.T) {
    RegisterFailHandler(Fail)
    RunSpecs(t, "Books Suite")
}
````

Let’s break this down:

Go allows us to specify the books_test package alongside the books package. Using books_test instead of books allows us to respect the encapsulation of the books package: your tests will need to import books and access it from the outside, like any other package. This is preferred to reaching into the package and testing its internals and leads to more behavioral tests. You can, of course, opt out of this – just change package books_test to package books
We import the ginkgo and gomega packages into the test’s top-level namespace by performing a dot-import. If you’d rather not do this, check out the Avoiding Dot Imports section below.
TestBooks is a testing test. The Go test runner will run this function when you run go test or ginkgo.
````
RegisterFailHandler(Fail): A Ginkgo test signals failure by calling Ginkgo’s Fail(description string) function. We pass this function to Gomega using RegisterFailHandler. This is the sole connection point between Ginkgo and Gomega.
````
RunSpecs(t *testing.T, suiteDescription string) tells Ginkgo to start the test suite. Ginkgo will automatically fail the testing.T if any of your specs fail.
At this point you can run your suite:

$ ginkgo #or go test

=== RUN TestBootstrap

Running Suite: Books Suite
==========================
Random Seed: 1378936983

Will run 0 of 0 specs


Ran 0 of 0 Specs in 0.000 seconds
SUCCESS! -- 0 Passed | 0 Failed | 0 Pending | 0 Skipped

--- PASS: TestBootstrap (0.00 seconds)
PASS
ok      books   0.019s